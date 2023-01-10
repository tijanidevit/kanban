<?php

namespace App\Http\Traits;
trait ResponseTrait {


    public function successResponse($message,$data=[],$statusCode=201)
    {
        return response([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
    public function retrievedResponse($data = [])
    {
        return response([
            'success' => true,
            'message' => "Resource or Collection retrieved successfully",
            'data' => $data
        ], 200);
    }

    public function updatedResponse($data = [])
    {
        return response([
            'success' => true,
            'message' => "Resource updated successfully",
            'data' => $data
        ], 200);
    }

    public function deletedResponse()
    {
        return response([
            'success' => true,
            'message' => "Resource deleted successfully",
        ], 200);
    }

    public function createdResponse($data=[])
    {
        return response([
            'success' => true,
            'message' => "Resource created successfully",
            'data' => $data,
        ], 201);
    }




    public function errorResponse($message,$statusCode)
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }

    public function notFoundResponse()
    {
        return response([
            'success' => false,
            'message' => "Resource not found",
        ], 404);
    }

    public function invalidEndpointResponse()
    {
        return response([
            'success' => false,
            'message' => "Endpoint not found",
        ], 404);
    }
    public function invalidMethodResponse()
    {
        return response([
            'success' => false,
            'message' => "Invalid method for endpoint",
        ], 405);
    }
}
?>