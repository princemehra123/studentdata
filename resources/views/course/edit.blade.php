@extends('layouts.app')
@section('content')



<div class="container border " style="box-shadow:1px 2px 5px black">
<form method="post" action="/course/{{$info['id']}}">
    @csrf
@method('patch')
<div class="mb-3">

<label for="name">Course Name</label>
<input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value={{$info['name']}}>

</div>


<div class="mb-3">
    
<label for="fees"></label> Enter Fees</label>
<input type="number" name="fees" class="form-control" id="fees" placeholder="Enter Fees" value={{$info['fees']}}>

</div>

<div class="mb-3">
    
<label for="discount"></label> Enter Discount</label>
<input type="number" name="discount" class="form-control" id="discount" placeholder="Enter Discount" value={{$info['discount']}}>

</div>



<!-- <div class="mb-3">
    
<label for="afterdiscount"></label> After Discount</label>
<input type="number" name="discount" class="form-control" id="afterdiscount" placeholder= "After Discount" value={{$info['afterdiscount']}}>

</div> -->

<div class="mb-3 text-center">
    
<button class="btn btn-success">Update</button>
</div>
</form>
</div>

@endsection