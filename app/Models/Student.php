<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable=['name','mobile','parentname','parentmobile','gender','address','dob','doj','email','refernceby','photo'];
    public function allcourse()
    {
        return $this->hasMany(StudentCourse::class,'student_id','id');
    }

    public function course()
    {
        return $this->hasOne(StudentCourse::class,'student_id','id');
    }
}
