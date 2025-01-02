<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'number_of_passengers',
        'passenger_details',
        'payment_method',
        'ticket_price',
        'bank_account',
        'va_number', 
        'dana_number',
        'seat_details',
        'status'
    ];

    protected $casts = [
        'passenger_details' => 'array',
        'seat_details' => 'array'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
