<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'total_amount',
        'status',
        'destination',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
