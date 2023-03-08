@extends('layouts.app')
@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Update Token</h2>
            </div>
            <div class="pull-right">
                <!-- <a class="btn btn-primary" href="">button</a> -->
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



    <form action="{{route('ticket.update',$tickets->id)}}" method="POST">
    	@csrf
        <div class="col-xs-12 col-sm-12 col-md-12">
  <label>Select Department</label>
  

  <select id="department" name="department_id" class="form-control" multiple>
  <option value="0"></option>

   @foreach ($departments as $department)
   <option value="{{ $department->id }}" {{($tickets->departments->id==$department->id) ? 'selected':'' }}>{{ $department->name }}</option>
   
   @endforeach
   

 
  </select>

</div>
          
<div class="col-xs-12 col-sm-12 col-md-12">
    <label>Write complain</label>
    <textarea class="form-control" id="" name="ticket" value="{{ $tickets->id }}"  rows="3">{{$tickets->ticket_generator}}</textarea>
  </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		


    </form>
    @endsection('content')