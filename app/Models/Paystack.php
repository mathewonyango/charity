<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paystack extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'paystack';

    // The attributes that are mass assignable
    protected $fillable = [
        'email',
        'order_id',
        'amount',
        'quantity',
        'currency',
        'reference',
        'metadata',
        'status',
    ];

    // Cast metadata as an array
    protected $casts = [
        'metadata' => 'array',
    ];
}
