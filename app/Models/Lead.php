<?php

namespace App\Models;

use App\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'nama', 'no_hp', 'no_hp_ortu', 'email', 'asal_sekolah', 'kelas',
        'program_minat', 'sumber', 'status', 'catatan',
        'utm_source', 'utm_campaign', 'ip_address', 'user_agent',
    ];

    protected $casts = [
        'status' => LeadStatus::class,
        'contacted_at' => 'datetime',
        'converted_at' => 'datetime',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(LeadEvent::class)->latest('created_at');
    }
}
