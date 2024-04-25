<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'latitude',
        'longitude',
    ];

    public function scopeWithinDistance($query, $latitude, $longitude, $radius = 10)
    {
        return $query
            ->select('id', 'title', 'description', 'latitude', 'longitude')
            ->selectRaw(
                "(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance",
                [$latitude, $longitude, $latitude]
            )
            ->having('distance', '<=', $radius);
    }
}