@extends('layouts.app')
@section('content')


<div class="container border border-dark " style="box-shadow:1px 2px 5px black">
@if($gt=Session::get('grt'))

<div class="alert alert-success">

{{$gt}}
</div>
@endif
<div class="p-3"> <a href="/student/create" class="btn btn-primary" >Add New student</a></div>
<table class="table table-striped">
<thead>
    <tr>
        <th>S.No.</th>
        <th>student Name</th>
        <th>Fees</th>
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

    <td>
        @php
        $allcourse=[];
        $allcourseid=[];
        $firstcourse="";
        foreach($info->allcourse as $cid){

            if(isset($cid['name'])){
                if(!$firstcourse){
                    $firstcourse=$cid;
                }
                $allcourse[]=$cid['name'];
                $allcourseid[$cid['course_id']]=$cid['name'];
            }

        }
        $allcourse=implode(',',$allcourse);
        @endphp





<!-- Button trigger modal -->
<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal_{{$info['id']}}">
Fee Structure
  </button>

  <!-- Modal -->
  <div class="modal fade" id="modal_{{$info['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$info['name']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>


        <form method="post" action="/studentcourse/{{$info['id']}}" id="frm_{{$info['id']}}">
              @csrf
            @method('get')
        <div class="modal-body">

            <div class="container border" >
                @foreach ($errors->all() as $e )
                <div class="alert alert-danger">{{$e}}</div>

                @endforeach



             <div class="mb-3">

             <label for="name">Select Course</label>

             <select  name="name"  class="form-select"  onchange="loadInfo(frm_{{$info['id']}},{{$info['id']}})" id="name" required >
                @foreach($allcourseid as $key=>$value)

                <option value="{{$key}}">{{$value}}</option>
                @endforeach


            </select>
             </div>

             <div class="mb-3">

             <label for="fees">Enter Fees</label>
             <input type="number" name="fees"  readonly class ="form-control"id="fees" placeholder="Enter Fees" value="{{$firstcourse['fees']}}"required>

             </div>

             <div class="mb-3">

             <label for="discount">Enter Discount</label>
             <input type="number" name="discount" min="0" max="100"value="{{$firstcourse['discount']}}" class="form-control"id="discount" placeholder="Enter Discount" onchange="changefees(frm_{{$info['id']}})" onkeyup="changefees(frm_{{$info['id']}})">
            </div>

            <div class="mb-3">

                <label for="finalprice">Final Fees</label>
                <input type="number" name="finalprice" value="{{$firstcourse['fees']-$firstcourse['fees']*$firstcourse['discount']/100}}"

                class="form-control"id="finalprice" placeholder="Enter Final Fees"

                onchange="changefees2(frm_{{$info['id']}})" onkeyup="changefees2(frm_{{$info['id']}})">
            </div>


                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary">Save changes</button>
                </div>
         </form>


      </div>
    </div>
  </div>



    </td>


        <td> <a class="link-offset-2 link-underline link-underline-opacity-0" href="tel:{{$info['mobile']}}">{{$info['mobile']}}</a></td>

        <td>{{$info['doj']}}</td>

        <td>
            {{$allcourse}}
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


<script>
    function loadInfo(frm,sid){
      $.ajax({
          url:'/course/'+frm.name.value+"/"+sid,
          type:"get",
          success:function(r){
             frm.fees.value=r.fees;
             frm.discount.value=r.discount;
             frm.finalprice.value=r.fees-r.fees*r.discount/100;
          }
        });
    }

    function changefees(frm)
    {
        if(frm.discount.value<=100 && frm.discount.value>=0)
            frm.finalprice.value=frm.fees.value-frm.fees.value*frm.discount.value/100;


  }

  function changefees2(frm)
  {
    frm.discount.value=(frm.fees.value-frm.finalprice.value)*100/frm.fees.value;
  }







</script>
@endsection
