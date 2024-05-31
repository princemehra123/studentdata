<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable=['name','fees','discount','afterdiscount'];

    public function allstudent()
    {
        return $this->hasMany(StudentCourse::class,'student_id','id');
    }

    public function student()
    {
        return $this->hasOne(StudentCourse::class,'student_id','id');
    }
}
