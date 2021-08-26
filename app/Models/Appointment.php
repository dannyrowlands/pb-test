<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Appointment extends Model
{
    use HasFactory;

        /**
     * Get the date for the appointment.
     */
    public function date()
    {
        return $this->hasOne(Date::class);
    }

    /**
     * Get the time for the appointment.
     */
    public function time()
    {
        return $this->hasOneThrough(Time::class, Date::class);
    }

    /**
     * Get the end end time for the appointment.
     */
    public function endtime()
    {
        return $this->hasOneThrough(Endtime::class, Date::class);
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
        return $this->belongsTo(User::class);
    }

    /**
     * Get the notes for the appointment.
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public static function createAppointment(Request $request) : Appointment
    {
        try {
            $time = new Time();
            $time->time = $request->starttime;
            $time->save();

            $endtime = new Endtime();
            $endtime->time = $request->endtime;
            $endtime->save();

            $date = new Date();
            $date->date = $request->date;
            $date->time_id = $time->id;
            $date->endtime_id = $endtime->id;
            $date->save();

            $appointment = new Appointment();
            $appointment->date_id =$date->id;
            $appointment->service_id = $request->service;
            $appointment->user_id = $request->user;
            $appointment->save();

            return $appointment;
        } catch (\Exception $e) {
            report($e);
        }
    }

    public static function updateAppointment(Request $request, $id) : Appointment
    {
        try {
            $time = new Time();
            $time->time = $request->starttime;
            $time->save();

            $endtime = new Endtime();
            $endtime->time = $request->endtime;
            $endtime->save();

            $date = new Date();
            $date->date = $request->date;
            $date->time_id = $time->id;
            $date->endtime_id = $endtime->id;
            $date->save();

            $appointment = Appointment::where('id', $id)->get()->first();
            $appointment->date_id = $date->id;
            $appointment->service_id = $request->service;
            $appointment->user_id = $request->user;
            $appointment->save();

            return $appointment;
        } catch (\Exception $e) {
            report($e);
        }
    }

    public static function deleteAppointment(Request $request, $id) : void
    {
        try {
            Appointment::destroy($id);
        } catch (\Exception $e) {
            report($e);
        }
    }
}
