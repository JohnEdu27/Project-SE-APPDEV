<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Officials extends Model
{
    protected $fillable = ['name', 'position', 'contact', 'categories', 'is_active', 'is_default'];

    protected $casts = [
        'categories' => 'array',
        'is_active'  => 'boolean',
        'is_default' => 'boolean',
    ];

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class, 'assigned_official_id');
    }
}
