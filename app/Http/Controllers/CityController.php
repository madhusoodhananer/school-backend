<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends SchoolController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
    }

    public function getCities(Request $request)
    {
        /**
         * Retrieves cities based on the state ID.
         *
         * @param Illuminate\Http\Request $request The HTTP request object
         * @return Illuminate\Http\JsonResponse The JSON response with the cities data
         */
        try {
            $cities = City::where('state_id', $request->state_id)->get();
            $response = [
                'cities' => $cities->toArray()
            ];
            return $this->sendSuccessResponse($response, 'success');
        } catch (\Throwable $exception) {
            return $this->sendErrorResponse('', $exception);
        }
    }
}
