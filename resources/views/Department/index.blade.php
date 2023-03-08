@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Department</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('departmentcreate') }}"> Create New Department</a>
            <a class="btn btn-primary float-right" href="{{ url('/home') }}"> Back</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th >Action</th>
   
   
 </tr>
 @foreach ($department as $key=>  $department)
       
 <div class="modal fade" id="confirmDeleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <b style="color:red;"> ARE YOU WANTS TO DELETE THIS ?</b>
      </div>
      <div class="modal-footer">
      <form method="get" action="{{route('department.destroy',$department->id)}}">
      @csrf
      
  
       
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit"  class="btn btn-danger">YES</button>
        </form>
      </div>
    </div>
  </div>
</div>


  <tr>
  <td>{{++$key}}</td>
    <td>{{$department->name}}</td>
    
    <td>{{$department->status}}</td>
     <td><a class="btn btn-primary" href="{{ route('department.show',$department->id) }}">show</a>
     <a class="btn btn-primary" href="{{ route('department.edit',$department->id) }}">edit</a>
     <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModel">
 Delete
</button>
    </td>
    
  </tr>
 @endforeach
</table>
@endsection




