<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image',
        'image_type',   // 'default' | 'hover' | 'banner' | 'story'
        'is_default',
        'sort_order',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    // Scopes
    public function scopeDefault($q)
    {
        return $q->where('image_type', 'default');
    }
    public function scopeHover($q)
    {
        return $q->where('image_type', 'hover');
    }
    public function scopeBanner($q)
    {
        return $q->where('image_type', 'banner');
    }
    public function scopeStory($q)
    {
        return $q->where('image_type', 'story');
    }  // ← add this

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}