@extends('layouts.app')
@section('content')
<form action="{{route('departmentUpdate',$department->id)}}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" class="form-control" value='{{$department->name}}'>
		        </div>
		    </div>
		   
            
           
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">update</button>
		    </div>
		</div>


    </form>

    




@endsection