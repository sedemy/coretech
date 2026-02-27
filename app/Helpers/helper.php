<?php

if (!function_exists('throwError')) {
    function throwError($msg)
    {
        throw new \Exception($msg);
    }
}

if (!function_exists('successResponse')) {
    function successResponse($data = [], $message = 'Success', $code = 200)
    {
        return response()->json(['success' => true,'message'=> $message, 'data' => $data], $code);
    }
}

if (!function_exists('failedResponse')) {
    function failedResponse($message = 'Failed', $code = 422)
    {
        return response()->json(['success' => false,'message'=> $message], $code);
    }
}
