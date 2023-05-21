<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchoolClassResource extends JsonResource
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
           'description' => $this->description,
           'max_student_cnt' => $this->max_student_cnt,
            'department' => $this->department->name,
            'member' => $this->member->name,
            'active' => $this->active ? 'Yes' : 'No',

       ];
    }
}
