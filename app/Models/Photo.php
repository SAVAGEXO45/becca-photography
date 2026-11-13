<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'subtitle',
        'description',
        'image_path',
        'thumbnail_path',
        'aspect_ratio',
        'dimensions',
        'client_name',
        'location',
        'shoot_date',
        'camera_gear',
        'is_featured',
        'is_hero',
        'display_order',
        'is_published',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_hero' => 'boolean',
        'is_published' => 'boolean',
        'display_order' => 'integer',
        'shoot_date' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getUrlAttribute(): string
    {
        if (Str::startsWith($this->image_path, ['http://', 'https://'])) {
            return $this->image_path;
        }

        // Check if path already starts with storage/
        if (Str::startsWith($this->image_path, 'storage/')) {
            return asset($this->image_path);
        }

        return asset('storage/photos/' . ltrim($this->image_path, '/'));
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->shoot_date ? $this->shoot_date->format('M Y') : 'Recent Work';
    }
}
