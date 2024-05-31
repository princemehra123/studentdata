@extends('layouts.app')
@section('content')


<div class="container border" >
   @foreach ($errors->all() as $e )
   <div class="alert alert-danger">{{$e}}</div>
   
   @endforeach
<form method="post" action="/course/">
    @csrf

<div class="mb-3">

<label for="name">Name</label>
<input type="text" name="name"  class="form-control" id="name" placeholder="Enter Course Name" required>

</div>

<div class="mb-3">
    
<label for="fees">Enter Fees</label>
<input type="number" name="fees" class="form-control"id="fees" placeholder="Enter Fees" required>

</div>
<div class="mb-3">
    
<label for="discount">Enter Discount</label>
<input type="number" name="discount" class="form-control"id="discount" placeholder="Enter Discount">

<!-- </div>
<label for="afterdiscount">After Discount</label>
<input type="number" name="discount" class="form-control"id="discount" placeholder="Enter Discount">

</div> -->

<div class="mb-3 text-center">
    
<button class="btn btn-success">Save</button>
</div>


</form>
</div>
@endsection