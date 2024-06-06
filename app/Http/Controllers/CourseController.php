<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("course.index",['data'=>course::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("course.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>"required|min:3|max:40",
            'fees'=>"required|numeric|min:500"
    ]);
        $info=[
            'name'=>$request->name,
            'fees'=>$request->fees,
            'discount'=>$request->discount,
            'afterdiscount'=>$request->afterdiscount,
        ];
        course::create($info);
        return redirect('/course')->with('grt','Data Saved Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course,$id)
    {
        //
        $course=course::find($id);
        return $course;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
        return view("course.edit",['info'=>$course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
       $course->name=$request->name;
       $course->fees=$request->fees;
       $course->afterdiscount=$request->afterdiscount;
       $course->discount=$request->discount;
       $course->save();
       return redirect('/course')->with('grt','Data Updated Successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
        $course->delete();
       return redirect('/course')->with('grt','Data Deleted Successfully');


    }
}
