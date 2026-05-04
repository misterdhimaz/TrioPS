<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playstation extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'category',
        'price_per_hour',
        'status'
    ];


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
