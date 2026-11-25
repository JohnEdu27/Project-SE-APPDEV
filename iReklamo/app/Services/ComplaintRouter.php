<?php

namespace App\Services;

use App\Models\Complaint;
use App\Models\Officials;

/** Process 3: route a classified complaint to an official. */
class ComplaintRouter
{
    public function assign(Complaint $complaint): ?Officials
    {
        $category = $complaint->category;

        $official = $category ? $this->findOfficial($category) : null;
        $official ??= Officials::where('is_active', true)->where('is_default', true)->first();

        $complaint->update([
            'assigned_official_id' => $official?->id,
            'assigned_at'          => $official ? now() : null,
        ]);

        return $official;
    }

    private function findOfficial(string $category): ?Officials
    {
        return Officials::where('is_active', true)
            ->whereJsonContains('categories', $category)
            ->withCount(['complaints as open_count' => fn ($q) => $q->whereIn('status', ['pending', 'in_progress'])])
            ->orderBy('open_count')
            ->orderBy('id')
            ->first();
    }
}