<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $fillable = [
        'menu_category_id',
        'name',
        'slug',
        'description',
        'price',
        'image',
        'is_best_seller',
        'is_featured',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_best_seller' => 'boolean',
        'is_featured' => 'boolean',
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
