<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    use HasFactory;
    protected $fillable=['student_id','course_id','name','fees','discount','finalprice'];
    public function studentIds()
    {
        return $this->belongsToMany(Student::class,'student_id','id');
    }

    public function courseIds()
    {
        return $this->belongsToMany(Course::class,'course_id','id');
    }

    public function studntId()
    {
        return $this->belongsTo(Student::class,'student_id','id');
    }

    public function courseId()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }
}
