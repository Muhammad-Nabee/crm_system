@extends('layouts.app')
@section('content')
@foreach ($user as $user)

<form action="{{route('profile/update',$user->id)}}" method="POST" enctype="multipart/form-data" >
@csrf  
<div class="form-group">
    <label>Name</label>
    <input type="name" class="form-control" name="name"  value="{{$user->name}}">
   
  </div>
  <label>Name</label>
    <input type="email" class="form-control" name="email"  value="{{$user->email}}">
   
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" id="" name="password">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" id="" name="confirm-password">
  </div>
  <label >Choose file to upload</label>
    <input type="file" id="file" name="old_img"/>
  @if(!empty($user->image))
        <img src="{{asset('upload/userimg/'.$user->image)}}" alt="" style="width:50px;height:50px">
      
    
    @else

       <img src="{{asset('public/upload/userimg/dummy.jpg')}}" alt="">
    
    @endif   
  <button type="submit" class="btn btn-primary">update</button>
</form>



@endforeach


@endsection