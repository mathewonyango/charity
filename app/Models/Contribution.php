<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'goal_amount',
        'description',
        'duration',
        'organizer_name',
        'organizer_contact',
        'status',
        'image'
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
