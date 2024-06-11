<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\StudentCourse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=Student::all();
        return view("student.index",compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cdata=Course::all(['id','name']);
        return view("student.create",compact('cdata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

         $request->validate([

            'name'=>"required|min:2|max:40",
            'mobile'=>"required|min:10|max:12",
            'photo'=>"required|file|image|mimes:jpeg,jpg|max:5120"
         ]);

 $filename=time() . '_' . $request->photo->getClientOriginalName();


$request->photo->move(public_path('photo'),$filename);

        $info=[

            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'parentname'=>$request->parentname,
            'parentmobile'=>$request->parentmobile,
            'address'=>$request->address,
            'gender'=>$request->gender,
            'refernceby'=>$request->refernceby,
            'dob'=>$request->dob,
            'email'=>$request->email,
            'doj'=>$request->doj,
            'photo'=>$filename??"",

        ];
        $obj=Student::create($info);
        if(count($request->course_id)>0)
        {
            foreach($request->course_id as $cid)
            {
                $cdtl=course::find($cid);
              $csinfo=[
                    'course_id'=>$cid,
                    'student_id'=>$obj->id,
                    'name'=>$cdtl->name,
                    'fees'=>$cdtl->fees,
                    'discount'=>$cdtl->discount,
                    'finalprice'=>$cdtl->discount?$cdtl->fees-$cdtl->fees*$cdtl->discount/100:$cdtl->fees

                    ];

                StudentCourse::create($csinfo);

            }

        }
        return redirect('/student')->with('grt','Data Saved Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //

        $course=array_column($student->allcourse->toArray(),'course_id');

        return view('student.edit',['info'=>$student,'cdata'=>course::all(['id','name']),'course'=>$course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //

            $filename=$student->photo;
            if($request->photo){
                if($filename){
                    unlink("photo\\$filename");
                }


            $filename=time() . '_' . $request->photo->getClientOriginalName();


            $request->photo->move(public_path('photo'),$filename);
        }

            $student->name=$request->name;
            $student->mobile=$request->mobile;
            $student->parentname=$request->parentname;
            $student->parentmobile=$request->parentmobile;
            $student->address=$request->address;
            $student->gender=$request->gender;
            $student->refernceby=$request->refernceby;
            $student->dob=$request->dob;
            $student->email=$request->email;
            $student->doj=$request->doj;
            $student->photo=$filename??"";
            $student->save();


            if(count($request->course_id)>0)
            {
                $sid=$student->id;
                StudentCourse::where('student_id',$sid)->delete();


                foreach($request->course_id as $cid)
                {
                    $cdtl=course::find($cid);
                    $csinfo=[
                          'course_id'=>$cid,
                          'student_id'=>$student->id,
                          'name'=>$cdtl->name,
                          'fees'=>$cdtl->fees,
                          'discount'=>$cdtl->discount,
                          'finalprice'=>$cdtl->discount?$cdtl->fees-$cdtl->fees*$cdtl->discount/100:$cdtl->fees

                          ];



                    StudentCourse::create($csinfo);

                }
            }



        return redirect('/student')->with('grt','Data Updated Successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }


    public function studentcourse($id)
    {

        $cid=request('name');
        $sc=StudentCourse::where(['student_id'=>$id,'course_id'=>$cid])->first();

        if($sc){
            $sc->discount=request('discount');
            $sc->finalprice=request('finalprice');
            $info=$sc->toArray();
            unset($info['student_id'],$info['course_id'],$info['created_at'],$info['updated_at']);
            StudentCourse::where(['student_id'=>$id,'course_id'=>$cid])->update($info);
            return redirect('/student')->with('grt','Fees Updated Successfully');

        }
    }
}
