@extends('layouts.app')
@section('content')


<div class="container border border-dark " style="box-shadow:1px 2px 5px black">
@if($gt=Session::get('grt'))

<div class="alert alert-success">

{{$gt}}
</div>
@endif
<div class="p-3"> <a href="/course/create" class="btn btn-primary" >Create Course</a></div>
<table class="table table-striped">
<thead>
    <tr>
        <th>S.No.</th>
        <th>Course Name</th>
        <th>Fees</th>
        <th>Discount</th>
        <th>After Discount</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody>
    @foreach ($data as $info)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>
        <a href="/course/{{$info['id']}}/edit" class="link-offset-2 link-underline link-underline-opacity-0" title="Edit">
        {{$info['name']}}</a>
    </td>
        <td>{{$info['fees']}}</td>
        <td>{{$info['discount']?$info['discount'].'%': 'N/A'}}</td>
        <td>{{$info['discount']?$info['fees']-($info['fees']*$info['discount']/100): $info['fees']}}</td>

        <td>
            <form method="post"action="/course/{{$info['id']}}">
            @csrf
            @method('delete')
        
        
            <button class="btn btn-danger" onclick="return confirm('Do you really want to delete this record?')">Delete</button>
        </form>
        </td>
        
    </tr>
    
    @endforeach
</tbody>
</table>

<div class="text-center">
<span class="text-muted" >To edit click on course name</span>
</div>


</div>

@endsection
