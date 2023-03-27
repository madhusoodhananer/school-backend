<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\SchoolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends SchoolController
{
    public function login(Request $request)
    {

        try {
            Validator::make($request->all(),[
                'username' => 'required',
                'password' => 'required'
            ])->validate();
            $success = [];

            if(Auth::attempt([
                'username' => $request->username,
                'password' => $request->password
            ])){
                $user = Auth::user();
                $success = [
                    'token' => $user->createToken('API Token')->plainTextToken,
                    'name'  => $user->name,
                    'code'  => Response::HTTP_OK
                ];
                return $this->sendSuccessResponse($success,'User loggined successfully');
            }
            else{
                return response()->json([
                    'message' => 'Incorrect username or password',
                    'code'    => Response::HTTP_UNAUTHORIZED
                ]);
            }
        } catch (\Throwable $th) {
            return $this->handleApiException($th);
        }
    }

    public function logout(Request $request)
    {
        try {
            auth()->user()->tokens()->delete();
            $cookie = Cookie::forget(config('session.cookie'));
            return $this->sendSuccessResponse(["cookie" => $cookie],'User logged out successfully');
        } catch (\Throwable $exception) {
            return $exception;
            return $this->HandleApiException($exception);
        }
    }
}
