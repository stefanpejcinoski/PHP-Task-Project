<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $fillable = ['city_id', 'temperature', 'humidity', 'weather_description'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
