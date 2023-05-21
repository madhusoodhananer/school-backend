<?php

namespace App\Http\Controllers;

use App\Http\Resources\SchoolClassResource;
use App\Models\SchoolClass;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolClassController extends SchoolController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $schoolClasses = SchoolClass::with(['department', 'member'])->paginate(10);
            // make data variable with
            $data = $this->paginatedResourceCollection(SchoolClassResource::class, $schoolClasses);
            return $this->sendSuccessResponse($data, 'Scholl class fetched successfully');
        } catch (Exception $exception) {

            return $this->handleApiException($exception);
        }
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
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'max_student_cnt' => 'required|integer',
                'department_id' => 'required|exists:departments,id',
                'member_id' => 'required|exists:members,id',
                'active' => 'required|boolean',
            ]);
            $validator->validate();
            $inputs = $validator->safe()->only([
                'name',
                'description',
                'max_student_cnt',
                'department_id',
                'member_id',
                'active',
            ]);
            $schoolClass = SchoolClass::create($inputs);
            return $this->sendSuccessResponse($schoolClass, 'New class has been created');
        } catch (Exception $exception) {

            return $this->handleApiException($exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolClass $schoolClass)
    {
        try {
            return $this->sendSuccessResponse($schoolClass, 'School class fetched successfully');
        } catch (Exception $exception) {
            return $this->handleApiException($exception);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolClass $schoolClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolClass $schoolClass)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'max_student_cnt' => 'required|integer',
                'department_id' => 'required|exists:departments,id',
                'member_id' => 'required|exists:members,id',
                'active' => 'required|boolean',
            ]);
            $validator->validate();
            $inputs = $validator->safe()->only([
                'name',
                'description',
                'max_student_cnt',
                'department_id',
                'member_id',
                'active',
            ]);
            $schoolClass->update($inputs);
            return $this->sendSuccessResponse($schoolClass, 'School class updated successfully');
        } catch (Exception $exception) {
            return $this->handleApiException($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolClass $schoolClass)
    {
        //make a delete fuctionality with try catch and return like above
        try {
            $schoolClass->delete();
            return $this->sendSuccessResponse($schoolClass, 'School class deleted successfully');
        } catch (Exception $exception) {
            return $this->handleApiException($exception);
        }
    }
}
