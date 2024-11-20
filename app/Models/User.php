<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'phone_number',
        'email',
        'password',
        'status', // Add the status field to the fillable array
        'open'

    ];

    // Define relationships
    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class,'creator_id');
    }
}
