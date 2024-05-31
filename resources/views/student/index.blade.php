@extends('layouts.app')
@section('content')


<div class="container border border-dark " style="box-shadow:1px 2px 5px black">
@if($gt=Session::get('grt'))

<div class="alert alert-success">

{{$gt}}
</div>
@endif
<div class="p-3"> <a href="/student/create" class="btn btn-primary" >Create student</a></div>
<table class="table table-striped">
<thead>
    <tr>
        <th>S.No.</th>
        <th>student Name</th>
        <th>Mobile</th>
        <th>Date of Joining</th>
        <th>Courses</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody>
    @foreach ($data as $info)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>
        <a href="/student/{{$info['id']}}/edit" class="link-offset-2 link-underline link-underline-opacity-0" title="Edit">
        {{$info['name']}}</a>
    </td>
        <td> <a class="link-offset-2 link-underline link-underline-opacity-0" href="tel:{{$info['mobile']}}">{{$info['mobile']}}</a></td>
        <td>{{$info['doj']}}</td>
        <td>
            @foreach ($info['allcourse'] as $cid)

            {{$cid['courseId']['name'].","}}
            @endforeach
        </td>

        <td>
            <form method="post"action="/student/{{$info['id']}}">
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
<span class="text-muted" >To edit click on student name</span>
</div>


</div>

@endsection
