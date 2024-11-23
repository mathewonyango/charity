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
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getIsActiveAttribute()
    {
        $now = Carbon::now();
        return $now->greaterThanOrEqualTo(Carbon::parse($this->start_date)) && $now->lessThanOrEqualTo(Carbon::parse($this->end_date));
    }
}
