<?php

namespace App\Http\Controllers;
use App\Exceptions\SchoolException;
use App\Models\Member\Member;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use function response;
class SchoolController extends Controller
{
    public function sendSuccessResponse($data,$message,int $code = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'success'=>true,
            'data'=>$data,
            'message'=>$message
        ];
        return response()->json($response, $code);
    }

    public function sendErrorResponse($message,$data=[],int $code=Response::HTTP_NOT_FOUND): JsonResponse
    {
        $response = [
            'status' => false,
            'message' => $message,
        ];
        if (!empty($data)) {
            $response['data'] = $data;
        }
        return response()->json($response, $code);
    }

    public function handleApiException(Exception $exception):JsonResponse
    {
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        $response=[];
        $message ='Exception occurred';
        $response['message']='Execution is terminated due to an exception';
        $response['data']=$exception;
        if($exception instanceof ValidationException)
        {

            $message             = 'Validation error occurred';
            $response['message'] = 'You provide an invalid data. Please check the data you entered';
            $response['errors']  = $exception->errors();
            $code                = Response::HTTP_UNPROCESSABLE_ENTITY;
        }
        if ($exception instanceof SchoolException) {
            $message = "There is an error occurred during process your data";
            $response["message"] = $exception->getMessage();
            $response["data"] = $exception->getData();
        }
        if($exception instanceof ModelNotFoundException )
        {
            $message = "Object Not Found.!";
            $response["message"] = "No result found for the given parameters";
            $code = Response::HTTP_NOT_FOUND;
        }
        if($exception instanceof QueryException)
        {
            $message = "Database Exception Occurred.!";
            $response["message"] = "Whoops, A Database exception prohibits the task from continuing with its execution. Please try again or contact the system administrator";
            $response['data']=$exception;
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        return $this->sendErrorResponse($message,$response,$code);
    }

}
