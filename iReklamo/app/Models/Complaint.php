<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use App\Models\Officials;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{

    public const URGENCIES = ['low', 'medium', 'high'];

    protected $fillable = [
        'complainant_name', 'contact', 'purok', 'text', 'predicted_category', 'confidence',
        'predicted_urgency', 'urgency_confidence', 'final_category', 'final_urgency',
        'needs_review', 'status', 'remarks','assigned_official_id', 'assigned_at' ,'user_id',
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

    public function getAssignedToAttribute(): ?string
    {
        return $this->officials ? "{$this->officials->name} ({$this->officials->position})" : null;
    }

    public function official(): BelongsTo
    {
        return $this->belongsTo(Officials::class, 'assigned_official_id');
    }
    protected static function booted(): void
    {
    static::creating(function ($c) {
        do {
            $code = 'BRGY-' . date('Y') . '-' . strtoupper(Str::random(6));
        } while (static::where('tracking_id', $code)->exists());
        $c->tracking_id = $code;
    });
}

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
}
