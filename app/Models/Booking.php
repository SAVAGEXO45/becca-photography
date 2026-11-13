<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_reference',
        'service_id',
        'service_name',
        'client_name',
        'client_email',
        'client_phone',
        'preferred_date',
        'preferred_time',
        'photoshoot_location',
        'additional_requirements',
        'status',
        'admin_notes',
        'confirmed_at',
        'completed_at',
        'cancelled_at',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'confirmed_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public static function generateReference(): string
    {
        do {
            $ref = 'BP-' . date('Y') . '-' . strtoupper(Str::random(5));
        } while (self::where('booking_reference', $ref)->exists());

        return $ref;
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'confirmed' => 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20',
            'completed' => 'bg-blue-500/10 text-blue-400 border border-blue-500/20',
            'cancelled' => 'bg-rose-500/10 text-rose-400 border border-rose-500/20',
            default => 'bg-amber-500/10 text-amber-400 border border-amber-500/20',
        };
    }
}
