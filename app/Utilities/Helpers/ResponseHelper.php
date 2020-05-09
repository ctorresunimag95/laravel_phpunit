<?php

namespace App\Utilities\Helpers;

use App\Models\Utilities\BaseResponseModel;
use App\Models\Utilities\ErrorResponseModel;
use Exception;

class ResponseHelper
{
    public static function GetSuccesResponse($success, $data = null, $responseCode)
    {
        $response = new BaseResponseModel;
        $response->success = $success;
        $response->data = $data;

        return response()->json($response, $responseCode);
    }

    public static function GetErrorResponse($success, $message, $exception, $responseCode, $errors = [])
    {
        $response = new ErrorResponseModel;
        $response->success = $success;
        $response->message = $message;
        $response->exceptionMessage = $exception->getMessage();
        $response->errors = $errors;

        return response()->json($response, $responseCode);
    }

    public static function GetErrorFromRequest($success, $message, $errors = [], $responseCode)
    {
        $response = new ErrorResponseModel;
        $response->success = $success;
        $response->message = $message;
        $response->errors = $errors;

        return response()->json($response, $responseCode);
    }

    public static function ParseResponseToJson($response)
    {
        $content = $response->getContent();
        $data = json_decode($content);

        if (is_null($data) && json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("JSON decode error");
        }

        return $data;
    }
}
