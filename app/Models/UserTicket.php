<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id', 'full_name', 'email', 'phone_number', 'booking_date',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
