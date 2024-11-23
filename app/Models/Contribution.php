<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'image',
    ];

    // Relationship with Paystack payments
    public function payments()
    {
        return $this->hasMany(Paystack::class, 'contribution_id');
    }

    // Calculate the current amount
    public function getCurrentAmountAttribute()
    {
        return $this->payments()->where('status', 'success')->sum('amount');
    }

    // Determine if the contribution is active
    public function isActive()
    {
        $currentDate = Carbon::now();
        return $this->current_amount < $this->goal_amount && $currentDate->lessThanOrEqualTo($this->end_date);
    }

    // Determine if the contribution is inactive
    public function isInactive()
    {
        $currentDate = Carbon::now();
        return $this->current_amount >= $this->goal_amount || $currentDate->greaterThan($this->end_date);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getEndDateAttribute()
    {
        return $this->updated_at
            ? Carbon::parse($this->updated_at)->addDays($this->duration)
            : null;
    }
}
