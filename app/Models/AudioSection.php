<?php
// app/Models/AudioSection.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AudioSection extends Model
{
    protected $table = 'audio_sections';

    protected $fillable = [
        'heading',
        'section_image',
        'audio_file',
    ];
}