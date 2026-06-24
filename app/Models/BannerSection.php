<?php
// app/Models/BannerSection.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerSection extends Model
{
    protected $table = 'banner_sections';

    protected $fillable = [
        'background_image',
        'heading',
    ];
}