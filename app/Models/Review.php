<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Review extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_photo',
        'rating',
        'review',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Scope
    |--------------------------------------------------------------------------
    */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    public function getCustomerPhotoUrlAttribute(): string
    {
        return $this->customer_photo
            ? asset($this->customer_photo)
            : asset('images/default-user.png');
    }

    public function getStarsAttribute(): array
    {
        return range(1, $this->rating);
    }
}
