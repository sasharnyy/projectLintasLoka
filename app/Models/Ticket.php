<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure',
        'destination',
        'departure_date',
        'departure_time',
        'return_date',
        'return_time',
        'price',
    ];

    protected $dates = ['departure_date', 'return_date'];

}
