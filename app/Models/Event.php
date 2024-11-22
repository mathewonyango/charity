<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'type',
        'start_date',
        'end_date',
        'venue',
        'status',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class ,'user_id');
    }
}
