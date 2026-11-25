<?php

namespace App\Http\Controllers;
use App\Services\ComplaintRouter;
use App\Models\Complaint;
use App\Services\ComplaintClassifier;
use App\Models\Officials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OfficialsController extends Controller
{
    private const STATUSES  = ['pending', 'in_progress', 'resolved', 'dismissed'];
    private const URGENCIES = ['high', 'medium', 'low'];

    // GET /official/dashboard?status=&urgency=&category=
    public function index(Request $request)
    {
        $complaints = Complaint::query()
            ->with(['user', 'official'])
            ->when($request->status, fn ($q, $v) => $q->where('status', $v))
            ->when($request->urgency, fn ($q, $v) =>
                $q->whereRaw('COALESCE(final_urgency, predicted_urgency) = ?', [$v]))
            ->when($request->category, fn ($q, $v) =>
                $q->whereRaw('COALESCE(final_category, predicted_category) = ?', [$v]))
            // open complaints first, then most urgent first, then newest
            ->orderByRaw("FIELD(status, 'pending', 'in_progress', 'resolved', 'dismissed')")
            ->orderByRaw("FIELD(COALESCE(final_urgency, predicted_urgency), 'low', 'medium', 'high') DESC")
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('official.dashboard', [
            'complaints' => $complaints,
            'counts'     => Complaint::selectRaw('status, COUNT(*) AS n')->groupBy('status')->pluck('n', 'status'),
            'categories' => Complaint::selectRaw('COALESCE(final_category, predicted_category) AS c')
                                ->distinct()->pluck('c')->filter()->values(),
            'statuses'   => self::STATUSES,
            'urgencies'  => self::URGENCIES,
        ]);
    }

    // PATCH /official/complaints/{complaint}/status
    public function updateStatus(Request $request, Complaint $complaint)
    {
        $data = $request->validate([
            'status'  => ['required', Rule::in(self::STATUSES)],
            'remarks' => ['nullable', 'string', 'max:1000'],
        ]);

        $complaint->update($data);

        return back()->with('success',
            "Complaint #{$complaint->id} is now " . str_replace('_', ' ', $data['status']) . '.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Officials $officials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Officials $officials)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Officials $officials)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Officials $officials)
    {
        //
    }

    public function OfficialPage() {
        return view('official.dashboard');
    }
}
