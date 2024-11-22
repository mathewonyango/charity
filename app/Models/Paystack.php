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
        'user_id',
        'contribution_id', // Foreign key for contribution
        'event_id',        // Foreign key for event
    ];

    // Cast metadata as an array
    protected $casts = [
        'metadata' => 'array',
    ];

    // Relationship to Contribution
    public function contribution()
    {
        return $this->belongsTo(Contribution::class, 'contribution_id');
    }

    // Relationship to Event
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
