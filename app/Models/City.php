<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function weather(){
        return $this->hasMany(Weather::class);
    }

    public function weatherToday(){
        return $this->hasMany(Weather::class)->where('created_at', Carbon::today()->get());
    }

    public function weatherLatest() {
        return $this->hasMany(Weather::class)->latest();
    }
}
