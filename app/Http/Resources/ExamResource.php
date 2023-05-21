<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'exam_controller' => $this->examController->first_name. $this->examController->last_name,
            'exam_controller_id' => $this->examController->id,
            'class' => $this->schoolClass->name,
            'class_id' => $this->schoolClass->id,
            'date' => date('d-M-Y',strtotime($this->start_date_time)),
            'end_date' => date('d-M-Y',strtotime($this->end_date_time)),
            'start_time' => date('h:i A',strtotime($this->start_date_time)),
            'end_time' => date('h:i A',strtotime($this->end_date_time)),
            'duration' => (strtotime($this->end_date_time) - strtotime($this->start_date_time)) / 60,
            // make publish_status like this 0= Not published 1 = published
            'is_published' => $this->is_published ? 'Yes' : 'No',

        ];
    }
}
