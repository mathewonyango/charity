<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'time',
        'venue',
        'map_link',
        'banner_image',
        'organizer_name',
        'status',
        'organizer_contact_info', // Added for contact information
        'event_coordinators',     // Added for event coordinators (can be stored as JSON or a separate table)
        'ticket_price',           // Added for the ticket price
        'registration_deadline', // Added for the registration deadline
        'event_capacity',         // Added for event capacity
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Accessor to check if the event is active based on dates
    public function getIsActiveAttribute()
    {
        $now = Carbon::now();
        return $now->greaterThanOrEqualTo(Carbon::parse($this->start_date)) && $now->lessThanOrEqualTo(Carbon::parse($this->end_date));
    }

    // Optional: If you are storing event coordinators as a JSON array in the database
    public function getEventCoordinatorsAttribute($value)
    {
        return json_decode($value);
    }

    // Optional: If you want to store a contact number and email separately
    public function getOrganizerContactInfoAttribute($value)
    {
        return json_decode($value);
    }

    // Optional: You can add mutators to handle storage of the array-like fields as JSON
    public function setEventCoordinatorsAttribute($value)
    {
        $this->attributes['event_coordinators'] = json_encode($value);
    }

    public function setOrganizerContactInfoAttribute($value)
    {
        $this->attributes['organizer_contact_info'] = json_encode($value);
    }
}
