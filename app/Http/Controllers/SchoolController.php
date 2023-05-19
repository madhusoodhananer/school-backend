<?php

namespace App\Http\Controllers;
use App\Exceptions\SchoolException;
use App\Models\Member\Member;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Mix;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use function response;
class SchoolController extends Controller
{
    /**
     * Sends a JSON response with a success status code
     *
     * @param mixed $data The data to include in the response
     * @param string $message A message to include in the response
     * @param int $code The HTTP status code to include in the response (default: 200 OK)
     * @return Illuminate\Http\JsonResponse A JSON response with the specified data, message, and status code
     */
    public function sendSuccessResponse($data,$message,int $code = Response::HTTP_OK): JsonResponse
    {

        $response = [
            'success'=>true,
            'data'=>$data,
            'message'=>$message
        ];
        return response()->json($response, $code);
    }

    /**
     * The function sends a JSON response with an error message, optional data, and a specified HTTP
     * status code.
     *
     * @param string $message The error message that will be returned in the JSON response.
     * @param array $data An optional parameter that can be passed to the function. It is an array
     * that can contain additional data to be included in the response. If no data is provided, the
     * response will only include the status and message.
     * @param int $code The code parameter is an optional HTTP response status code that can be passed
     * to the function. It defaults to 404 (Not Found) if not specified. The code parameter is used to
     * set the HTTP status code of the response.
     *
     * @return JsonResponse A JSON response with a status of false, a message, and optional data, with
     * an HTTP status code specified as a parameter.
     */
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
    /**
     * Sends a JSON response with an error message, optional data, and a specified HTTP status code.
     *
     * @param string $message The error message that will be returned in the JSON response.
     * @param array $data An optional parameter that can be passed to the function. It is an array
     *                     that can contain additional data to be included in the response. If no data is provided, the
     *                     response will only include the status and message.
     * @param int $code The code parameter is an optional HTTP response status code that can be passed
     *                  to the function. It defaults to 404 (Not Found) if not specified. The code parameter is used to
     *                  set the HTTP status code of the response.
     *
     * @return JsonResponse A JSON response with a status of false, a message, and optional data, with
     *                       an HTTP status code specified as a parameter.
     */
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

    public function paginatedResourceCollection($resource,$modelObject):mixed
    {
        return $resource::collection($modelObject)->response()->getData(true);
    }
}
