<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_method',
        'status'
    ];

    // Relasi Belongs-To: Pembayaran ini untuk 1 Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
