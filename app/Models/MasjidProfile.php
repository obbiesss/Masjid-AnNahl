<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasjidProfile extends Model
{
    protected $fillable = [
        'hero_subtitle',
        'about_image',
        'about_text_1',
        'about_text_2', 
        'visi',
        'misi',
        'capacity',
        'year',
        'routine_activities',
        'public_info',
        'whatsapp',
        'address',  
        'maps_embed',
        'operating_hours',
        'maps_url',
        'facilities',
    ];

    protected $casts = [
        'facilities' => 'array'
    ];
}