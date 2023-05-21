<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends SchoolController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $departments = Department::all();
            return $this->sendSuccessResponse([
                'departments' => $this->paginatedResourceCollection(DepartmentResource::class, $departments)
            ], 'Departments Listed Successfully');
        } catch (Exception $exception) {
            return $this->handleApiException($exception);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);
            $validator->validate();
            $department = Department::create($request->all());

            return $this->sendSuccessResponse([
                'id'          => $department->id,
                'name'        => $department->name,
                'description' => $department->description,
            ], 'Department has been created');
        } catch (Exception $exception) {
            return $this->handleApiException($exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        try {
            return $this->sendSuccessResponse([
                'department' => new DepartmentResource($department)
            ], 'Department fetched successfully');
        } catch (Exception $exception) {
            return $this->handleApiException($exception);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);
            $validator->validate();
            $department->update($request->all());
            return $this->sendSuccessResponse([],'Department has been updated');
        } catch (Exception $exception) {
            return $this->handleApiException($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return $this->sendSuccessResponse([],'Department has been deleted');
        } catch (Exception $exception) {
            return $this->handleApiException($exception);
        }
    }
}
