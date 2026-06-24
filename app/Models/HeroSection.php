<?php
// app/Models/HeroSection.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $table = 'hero_sections';

    protected $fillable = [
        'background_image',
        'heading_line1',
        'heading_line2',
        'btn1_label',
        'btn1_url',
        'btn2_label',
        'btn2_url',
    ];
}