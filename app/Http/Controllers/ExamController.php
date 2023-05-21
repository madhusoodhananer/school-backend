<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamResource;
use App\Models\Exam;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends SchoolController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $exams = Exam::with(['schoolClass', 'examController'])->paginate(10);
            // dd($exams);
            $data = $this->paginatedResourceCollection(ExamResource::class, $exams);
            return $this->sendSuccessResponse($data, 'Exam fetched successfully');
        } catch (Exception $exception) {
            return $exception;
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
        // dd($request->all());
        try {

            $validator = Validator::make($request->all(),[
                'class_id'             => 'required|exists:school_classes,id',
                'exam_controller_id'   => 'required|exists:members,id',
                'name'                 => 'required|string',
                'start_date_time'      => 'required|date',
                'end_date_time'        => 'required|date|after:start_date_time',
                'exam_time_validation' => 'required|in:QUESTION_WISE,EXAM_WISE',
                'time_limit_in_mins'   => 'required|integer|min:1',
                'is_published'         => 'boolean',
            ]);
            $validator->validate();
            $inputs = $validator->safe()->only([
                'class_id',
                'exam_controller_id',
                'name',
                'start_date_time',
                'end_date_time',
                'exam_time_validation',
                'time_limit_in_mins',
                'is_published',

            ]);
            $exam = Exam::create($inputs);
            return $this->sendSuccessResponse($exam, 'Exam created successfully');
        } catch (Exception $exception) {

            return $this->handleApiException($exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        try {
            return $this->sendSuccessResponse($exam, 'Exam fetched successfully');
        } catch (Exception $exception) {
            return $this->handleApiException($exception);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        try {
            $validator = Validator::make($request->all(),[
                'class_id'             => 'required|exists:school_classes,id',
                'exam_controller_id'   => 'required|exists:members,id',
                'name'                 => 'required|string',
                'start_date_time'      => 'required|date',
                'end_date_time'        => 'required|date|after:start_date_time',
                'exam_time_validation' => 'required|in:QUESTION_WISE,EXAM_WISE',
                'time_limit_in_mins'   => 'required|integer|min:1',
                'is_published'         => 'boolean',
            ]);
            $validator->validate();
            $inputs = $validator->safe()->only([
                'class_id',
                'exam_controller_id',
                'name',
                'start_date_time',
                'end_date_time',
                'exam_time_validation',
                'time_limit_in_mins',
                'is_published',
            ]);
            $exam->update($inputs);
            return $this->sendSuccessResponse($exam, 'Exam updated successfully');
        }
        catch (Exception $exception) {
            return $this->handleApiException($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        // make delete code with try catch
        try {
            $exam->delete();
            return $this->sendSuccessResponse($exam, 'Exam deleted successfully');
        } catch (Exception $exception) {

            return $this->handleApiException($exception);
        }


    }
}
