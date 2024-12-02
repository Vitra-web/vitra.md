<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.distancematrix.ai/maps/api/distancematrix/json?origins=47.015321391818205,28.872963180004227&destinations='.$latitude.','.$longitude.'&key='.env('DISTANCEMATRIX_KEY'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',

            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response, true);


        return response()->json([
            'result' => $result
        ]);


    }
}
