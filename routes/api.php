<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StateController;
use App\Models\Country;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)
    ->prefix('auth')
    ->as('auth.')
    ->group(function(){
        Route::post('login',[AuthController::class, 'login'])->name('login');
        Route::middleware('auth:sanctum')->group(function(){
            Route::post('logout', [AuthController::class,'logout'])->name('logout');
        });
    });


    Route::middleware('auth:sanctum')->group(function () {
        Route::resource('country',CountryController::class);
        Route::get('states',[StateController::class,'getStates'])->name('states');
        Route::get('cities',[CityController::class,'getCities'])->name('cities');
        Route::resource('member',MemberController::class);
        Route::resource('department',DepartmentController::class);
    });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
