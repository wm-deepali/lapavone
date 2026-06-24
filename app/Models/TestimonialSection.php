<?php
// app/Models/TestimonialSection.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialSection extends Model
{
    protected $table = 'testimonial_sections';

    protected $fillable = [
        'background_image',
        'quote_line1',
        'quote_line2',
        'author',
    ];
}