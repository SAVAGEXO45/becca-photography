<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'cover_image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class)->orderBy('display_order')->orderByDesc('id');
    }

    public function publishedPhotos(): HasMany
    {
        return $this->photos()->where('is_published', true);
    }
}
