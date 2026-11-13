<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'tagline',
        'description',
        'starting_price',
        'price_label',
        'duration',
        'deliverables',
        'turnaround_time',
        'features',
        'cover_image',
        'is_popular',
        'is_active',
        'order',
    ];

    protected $casts = [
        'starting_price' => 'decimal:2',
        'features' => 'array',
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return '₦' . number_format($this->starting_price, 0);
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        if (!$this->cover_image) {
            return null;
        }

        if (Str::startsWith($this->cover_image, ['http://', 'https://'])) {
            return $this->cover_image;
        }

        if (Str::startsWith($this->cover_image, 'storage/')) {
            return asset($this->cover_image);
        }

        return asset('storage/photos/' . ltrim($this->cover_image, '/'));
    }
}
