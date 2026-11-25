<?php

namespace App\Http\Controllers;

use App\Services\ComplaintRouter;
use App\Models\Complaint;
use App\Services\ComplaintClassifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    public function __construct(private ComplaintClassifier $classifier,
    private ComplaintRouter $router,) {}

    // POST /api/complaints
    public function store(Request $request)
    {
        $data = $request->validate([
            'complainant_name' => 'nullable|string|max:255',
            'contact'          => ['nullable','regex:/^(09|\+639)\d{9}$/'],
            'purok'            => 'nullable|string|max:100',
            'text'             => 'required|string|min:10|max:2000',
        ]);

        $pred = $this->classifier->classify($data['text']);

        $complaint = Complaint::create($data + [
            'user_id'            => $request->user()->id,
            'predicted_category' => $pred['category'] ?? null,
            'confidence'         => $pred['confidence'] ?? null,
            'predicted_urgency'  => $pred['urgency'] ?? null,
            'urgency_confidence' => $pred['urgency_confidence'] ?? null,
            'needs_review'       => $pred['needs_review'] ?? true, // NLP down -> staff classifies manually
        ]);

        $this->router->assign($complaint);

        if ($request->wantsJson()) {                       // keeps Postman testing working
            return response()->json($complaint->load('official'), 201);
        }

        return redirect()->route('my.complaints', $complaint->tracking_id)
            ->with('success', 'Complaint submitted! Save your tracking ID.');
    }

    public function track(string $trackingId)
    {
        $complaint = Complaint::with('official')->where('tracking_id', $trackingId)->firstOrFail();
        return view('complaints.track', compact('complaint'));
    }

    // GET /api/complaints?status=&category=&urgency=&purok=&needs_review=1&sort=urgency
    public function index(Request $request)
    {
        $q = Complaint::query()->latest();

        $q->when($request->status, fn ($q, $v) => $q->where('status', $v))
          ->when($request->purok, fn ($q, $v) => $q->where('purok', $v))
          ->when($request->category, fn ($q, $v) =>
              $q->whereRaw('COALESCE(final_category, predicted_category) = ?', [$v]))
          ->when($request->urgency, fn ($q, $v) =>
              $q->whereRaw('COALESCE(final_urgency, predicted_urgency) = ?', [$v]))
          ->when($request->boolean('needs_review'), fn ($q) =>
              $q->where('needs_review', true)->whereNull('final_category'));

        if ($request->sort === 'urgency') { // high first, then medium, low, unknown last
            $q->reorder()->orderByRaw(
                "FIELD(COALESCE(final_urgency, predicted_urgency), 'low', 'medium', 'high') DESC")->latest();
        }

        return $q->paginate(20);
    }

    public function show(Complaint $complaint)
    {
        return $complaint;
    }

    // PATCH /api/complaints/{id} -- staff updates status/remarks or corrects the category
    public function update(Request $request, Complaint $complaint)
    {
        $data = $request->validate([
            'status'         => ['sometimes', Rule::in(['pending', 'in_progress', 'resolved', 'dismissed'])],
            'remarks'        => 'sometimes|nullable|string',
            'final_category' => ['sometimes', Rule::in(array_keys(Complaint::ROUTING))],
            'final_urgency'  => ['sometimes', Rule::in(Complaint::URGENCIES)],
        ]);

        $complaint->update($data);
        return $complaint->fresh();
    }

    // GET /api/stats
    public function stats()
    {
        return [
            'by_category' => Complaint::select(
                    DB::raw('COALESCE(final_category, predicted_category) AS category'),
                    DB::raw('COUNT(*) AS n'))
                ->groupBy('category')->orderByDesc('n')->get(),
            'by_urgency' => Complaint::select(
                    DB::raw('COALESCE(final_urgency, predicted_urgency) AS urgency'),
                    DB::raw('COUNT(*) AS n'))
                ->groupBy('urgency')->get(),
            'by_status'         => Complaint::select('status', DB::raw('COUNT(*) AS n'))->groupBy('status')->get(),
            'staff_corrections' => Complaint::whereNotNull('final_category')->orWhereNotNull('final_urgency')->count(),
        ];
    }

    // POST /api/retrain -- sends staff-verified complaints to the Python service
    public function retrain(ComplaintClassifier $classifier)
    {
        // Only staff-verified labels are used; a complaint may have a verified category, urgency, or both
        $examples = Complaint::whereNotNull('final_category')->orWhereNotNull('final_urgency')
            ->get(['text', 'final_category', 'final_urgency'])
            ->map(fn ($c) => [
                'text'     => $c->text,
                'category' => $c->final_category,
                'urgency'  => $c->final_urgency,
            ])
            ->all();

        $result = $classifier->retrain($examples);
        return $result
            ? response()->json($result)
            : response()->json(['error' => 'NLP service unavailable'], 503);
    }
     public function indexREQ(Request $request)
    {
        $complaints = $request->user()->complaints()
            ->with(['user', 'official'])
            ->latest()
            ->paginate(10);

        return view('resident.complaint_tracking', compact('complaints'));
    }
}
