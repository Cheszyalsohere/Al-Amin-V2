<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'is_unique' => 'boolean',
        'created_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(fn ($model) => $model->created_at ??= now());
    }
}
