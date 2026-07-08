<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadEvent extends Model
{
    public $timestamps = false;

    protected $fillable = ['lead_id', 'event_type', 'old_status', 'new_status', 'note', 'actor'];

    protected $casts = ['created_at' => 'datetime'];

    protected static function booted(): void
    {
        static::creating(fn ($e) => $e->created_at ??= now());
    }
}
