<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'language',   // ← add
        'image',
        'short_description',
        'content',
        'meta_title',
        'meta_description',
        'show_home',
        'status'
    ];
}