<?php

namespace App\Http\Controllers;

use App\Models\Date;
use App\Models\Time;
use App\Models\Endtime;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function getAllForUser(Request $request)
    {
        try {
//            TODO :: IMPLEMENT CLIENTS AND SECURITY FOR EXTERNAL ACCESS
//            $this->validate($request, [
//                'client_id' => 'required|exists:clients',
//                'token' => 'required|string',
//            ]);


//            $client = Client::find($request->client_id);
//            if($client->token !== $request->token) {
//                return response()->json(['errors' => 'Token not recognised'], JsonResponse::HTTP_UNAUTHORIZED); //401
//            }

            //TODO:: This list needs to pull the data from relationships also for display to screen.
            $appointmentsList = Appointment::where('user_id', $request->user)->get();

            //TODO:: Rewrite this using magic methods once all relationships are set up.
            $dataForReturn = [];
            foreach($appointmentsList as $appointment)
            {
                $date = Date::where('id', $appointment->date_id)->get()->first();
                $dataForReturn[$appointment->id] = [
                    'appointment' => $appointment->id,
                    'date' => $date->date,
                    'start' => Time::where('id', $date->time_id)->get()->first()->time,
                    'end' => Endtime::where('id', $date->endtime_id)->get()->first()->time,
                    'service' => Service::where('id', $appointment->service_id)->get()->first()->name,
                    'service_id' => Service::where('id', $appointment->service_id)->get()->first()->id,
                ];
            }

            return(
                response()->json(
                    $dataForReturn,
                    JsonResponse::HTTP_OK
                )
            );
        } catch (\Exception $e) {
            report($e);
            throw new HttpResponseException(
                response()->json(['errors' => $e->getMessage()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY) //422
            );
        }
    }

    public function createAppointment(Request $request)
    {
        try {
            $this->validate($request, [
                'date' => 'required|date',
                'starttime' => 'required',
                'endtime' => 'required',
                'service' => 'required|int',
                'user' => 'required|int',
            ]);

            Appointment::createAppointment($request);
            return(
                response()->json('{ message: "Appointment Created"}', JsonResponse::HTTP_OK)
            );
        } catch (\Exception $e) {
            report($e);
            throw new HttpResponseException(
                response()->json(['errors' => $e->getMessage()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY) //422
            );
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'date' => 'required|date',
                'starttime' => 'required',
                'endtime' => 'required',
                'service' => 'required|int',
                'user' => 'required|int',
            ]);

            Appointment::updateAppointment($request, $id);
            return(
            response()->json('{ message: "Appointment Updated"}', JsonResponse::HTTP_OK)
            );
        } catch (\Exception $e) {
            report($e);
            throw new HttpResponseException(
                response()->json(['errors' => $e->getMessage()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY) //422
            );
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            Appointment::deleteAppointment($request, $id);
            return(
            response()->json('{ message: "Appointment Updated"}', JsonResponse::HTTP_OK)
            );
        } catch (\Exception $e) {
            report($e);
            throw new HttpResponseException(
                response()->json(['errors' => $e->getMessage()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY) //422
            );
        }
    }
}
