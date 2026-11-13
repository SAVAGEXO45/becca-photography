<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'service_interest',
        'message',
        'is_read',
        'admin_notes',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
