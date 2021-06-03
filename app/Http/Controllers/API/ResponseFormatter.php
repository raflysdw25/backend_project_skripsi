<?php

namespace App\Http\Controllers\API;

class ResponseFormatter
{
    protected static $response = [
        'response' =>[
            'code' => 200,
            'status' => 'success',
            'message' => null
        ],
        'data' => null
    ];

    // Fungsi untuk mengoutput data ketika success
    // $data dari database
    public static function success($data = null, $message=null, $code = 200)
    {

        self::$response['response']['code']= $code;
        self::$response['response']['message']= $message;
        self::$response['data']= $data;

        // Output JSON : menampilkan data dalam bentuk JSON response()->json(response,code)
        return response()->json(self::$response, self::$response['response']['code']);
    }

    public static function error($data = null, $message=null, $code = 400)
    {
        self::$response['response']['status']= 'error';
        self::$response['response']['code']= $code;
        self::$response['response']['message']= $message;
        self::$response['data']= $data;
        

        // Output JSON
        return response()->json(self::$response, self::$response['response']['code']);
    }
 
}