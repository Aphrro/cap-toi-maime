<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ReimbursementType extends Model
{
    protected $fillable = ['name', 'code', 'description', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function professionals(): BelongsToMany
    {
        return $this->belongsToMany(Professional::class, 'professional_reimbursement');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
