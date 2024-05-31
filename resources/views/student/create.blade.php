@extends('layouts.app')
@section('content')
<style>
    .dgrid{
        border: 1px solid #ddd;
        padding: 5px;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
    }
</style>

<div class="container border" >
   @foreach ($errors->all() as $e )
   <div class="alert alert-danger">{{$e}}</div>

   @endforeach
<form method="post" action="/student/" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name">Select Course:</label>
        <div class="dgrid">
            @foreach ($cdata as $cinfo  )
            <div>
                <input type="checkbox" id="c{{$cinfo['id']}}" name="course_id[]" value="{{$cinfo['id']}}">
                <label for="c{{$cinfo['id']}}">
            {{$cinfo['name']}}
        </label>
            </div>

            @endforeach
        </div>
    </div>





<div class="mb-3">
<label for="name">Name:</label>
<input type="text" name="name"  class="form-control" id="name" placeholder="Enter Student Name" required>
</div>


<div class="mb-3">
<label for="mobile"> Mobile:</label>
<input type="number" name="mobile" class="form-control"id="mobile" placeholder="Enter Mobile" required>
</div>


<div>
      <label >Gender:</label>
      <div class="form-control">
        <input type="radio" name="gender" value="male" id="m"><label for="m">Male</label>
        <input type="radio" name="gender" value="female" id="f"><label for="f">Female</label>
      </div>

</div>


<div class="mb-3">
<label for="parentname">Parent Name:</label>
<input type="text" name="parentname"  class="form-control" id="parentname" placeholder="Enter Parent Name" >
</div>


<div class="mb-3">
<label for="parentmobile">Parent Mobile:</label>
<input type="number" name="parentmobile" class="form-control"id="parentmobile" placeholder="Enter Parent Mobile" >
</div>


<div class="mb-3">
<label for="address"> Address:</label>
<input type="text" name="address" class="form-control"id="address" placeholder="Enter Address" >
</div>


<div class="mb-3">
<label for="email">Email:</label>
<input type="email" name="email" class="form-control"id="email" placeholder="Enter Email" >
</div>

<div class="mb-3">
<label for="refernceby">Reference By:</label>
<input type="text" name="refernceby" class="form-control"id="refernceby" placeholder="Who References You?" >
</div>


<div class="mb-3">
<label for="dob">Date of Birth:</label>
<input type="date" name="dob" class="form-control" id="dob" placeholder="Enter Dob" max="{{date('Y-m-d',time()-(86400*365.25*6))}}">
</div>

<div class="mb-3">
<label for="doj">Date of Join :</label>
<input type="date" name="doj" class="form-control" id="doj" placeholder="Enter Doj" value="{{date('Y-m-d',time())}}">
</div>

<div class="mb-3">
    <label for="photo">Image:</label>
    <input type="file" name="photo" class="form-control" id="photo" accept="image/*">
    </div>



<div class="mb-3 text-center">

<button class="btn btn-success">Save</button>
</div>


</form>
</div>
@endsection
