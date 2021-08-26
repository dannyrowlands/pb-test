<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ServiceController extends Controller
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

            return(
            response()->json(Service::all(), JsonResponse::HTTP_OK)
            );
        } catch (\Exception $e) {
            report($e);
            throw new HttpResponseException(
                response()->json(['errors' => $e->getMessage()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY) //422
            );
        }
    }
}
