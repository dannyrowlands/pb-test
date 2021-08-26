<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;

    /**
     * Get the appointment for this date record.
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Get the start time for this date record.
     */
    public function time()
    {
        return $this->hasOne(Time::class);
    }

    /**
     * Get the end time for this date record.
     */
    public function endtime()
    {
        return $this->hasOne(Endtime::class);
    }
}
