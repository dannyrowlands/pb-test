<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * Get the time for the appointment.
     */
    public function time()
    {
        return $this->hasOne(Time::class);
    }

    /**
     * Get the date for the appointment.
     */
    public function date()
    {
        return $this->hasOne(Date::class);
    }

    /**
     * Get the service for the appointment.
     */
    public function service()
    {
        return $this->hasOne(Service::class);
    }

    /**
     * Get the user for the appointment.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the notes for the appointment.
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
