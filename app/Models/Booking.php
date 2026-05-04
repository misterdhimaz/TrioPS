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
        'start_time',     // Text/JSON: ["10:00", "11:00"]
        'end_time',       // Dibiarkan jika masih ada di tabel
        'duration_hours', // Wajib ada
        'total_price',
        'status',         // Pending, Active, Completed, Cancelled
        'payment_proof'   // Path foto bukti transfer
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
