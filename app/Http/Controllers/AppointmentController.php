<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function getAll(Request $request)
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

                            //            $cliVerificaticationRequest = new CliVerificationRequest();
                            //            $cliVerificaticationRequest->client_id = $request->client_id;
                            //            $cliVerificaticationRequest->remote_user_id = $request->user_id;
                            //            $cliVerificaticationRequest->remote_session_id = $request->session_id;
                            //            $cliVerificaticationRequest->request_key = Uuid::uuid();
                            //            $cliVerificaticationRequest->options = $request->options;
                            //            $cliVerificaticationRequest->save();
            return(response()->json(Appointment::all(), JsonResponse::HTTP_OK));
        } catch (\Exception $e) {
            report($e);
            throw new HttpResponseException(
                response()->json(['errors' => $e->getMessage()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY) //422
            );
        }
    }


}
