<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $guarded = [];
    // make relation for schoolClass class_id in SchoolClass.id
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class,'class_id','id');
    }

    // make relation for examcontroller exam.exam_controller_id = member.id. also specify fk and pk in function
    public function examController()
    {
        return $this->belongsTo(Member::class, 'exam_controller_id', 'id');
    }
}
