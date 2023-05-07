<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends SchoolController
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
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $state)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        //
    }

    /**
     * This function retrieves states based on a given country ID and returns a success response with
     * the states array.
     *
     * @param Request request  is an instance of the Request class, which is used to retrieve
     * data from the HTTP request. It contains information about the current request, such as the HTTP
     * method, headers, and parameters. In this case, it is used to retrieve the country_id parameter
     * from the request.
     * @param State state The `` parameter is an instance of the `State` model, which is likely
     * used to interact with the `states` table in the database.
     *
     * @return a success response with an array of states belonging to a specific country, based on the
     * country_id passed in the request. The states are retrieved either by accessing the 'states'
     * property of a Country model instance found by the country_id, or by querying the State model for
     * states with the same country_id. The retrieved states are then returned in the 'states' key of
     * the success
     */
    public function getStates(Request $request, State $state)
    {
        //
        try {
            $statesObject = Country::find($request->country_id);
            $states = $statesObject->states;
            dd($states);
            $statesObject = $state::where('country_id',$request->country_id)->get();
            $success = [
                'states' => $statesObject->toArray(),
            ];
            return $this->sendSuccessResponse($success,'success');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
