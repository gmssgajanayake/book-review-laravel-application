<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeTitle(Builder $qurey, string $title): Builder
    {
        return $qurey->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopePopuler(Builder $qurey): Builder
    {
        return $qurey->withCount('reviews')
            ->orderBy('reviews_count', 'desc');
    }


    public function scopeHeighestRated(Builder $qurey): Builder
    {
        return $qurey->withAvg('reviews','rating')
            ->orderBy('reviews_avg_rating', 'desc');
    }






}
