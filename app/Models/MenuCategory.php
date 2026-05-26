<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    public function activeMenus(): HasMany
    {
        return $this->hasMany(Menu::class)
            ->where('status', true)
            ->orderBy('sort_order');
    }
}
