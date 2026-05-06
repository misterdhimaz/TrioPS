<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'playstation_id',
        'booking_date',
        'start_time',
        'end_time',
        'duration_hours', // Wajib ada
        'total_price',
        'status',
        'payment_proof'
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function playstation()
    {
        return $this->belongsTo(Product::class, 'playstation_id');
    }
}
