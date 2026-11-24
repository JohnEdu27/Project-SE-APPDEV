<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    // Edit to match your barangay's committees (keys must match the classifier's categories)
    public const ROUTING = [
        'noise'         => 'Peace and Order Committee',
        'garbage'       => 'Environment / Sanitation Committee',
        'road'          => 'Infrastructure Committee',
        'flooding'      => 'Disaster Risk Reduction (BDRRMC)',
        'peace_order'   => 'Barangay Tanod / Peace and Order',
        'utilities'     => 'Barangay Secretary',
        'stray_animals' => 'Health / Veterinary Committee',
    ];

    public const URGENCIES = ['low', 'medium', 'high'];

    protected $fillable = [
        'complainant_name', 'contact', 'purok', 'text', 'predicted_category', 'confidence',
        'predicted_urgency', 'urgency_confidence', 'final_category', 'final_urgency',
        'needs_review', 'status', 'remarks',
    ];

    protected $casts = ['needs_review' => 'boolean', 'confidence' => 'float', 'urgency_confidence' => 'float'];

    protected $appends = ['category', 'urgency', 'assigned_to'];

    public function getCategoryAttribute(): ?string
    {
        return $this->final_category ?? $this->predicted_category;
    }

    public function getUrgencyAttribute(): ?string
    {
        return $this->final_urgency ?? $this->predicted_urgency;
    }

    public function getAssignedToAttribute(): string
    {
        return self::ROUTING[$this->category] ?? 'Barangay Secretary';
    }
}
