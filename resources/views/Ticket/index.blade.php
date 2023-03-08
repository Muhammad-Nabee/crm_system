@extends('layouts.app')
@section('content')
<table class="table table-dark" id="ticketTable">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ticket</th>
      <th scope="col">Status</th>
      <th scope="col">ASSIGN FROM</th>
      <th scope="col">Department</th>
      <th scope="col">Assign TO</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
 

<tbody>
     
@foreach($tickets as $key=> $ticket)

<div class="modal fade" id="comment-{{$ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{route('ticket.comment',$ticket->id)}}">
      <div class="modal-body">
      <b style="color:red;"> REPLY ABOUT ISSUE OCCUR ?</b>
      
        <input type="hidden" name="commentid" value="{{$ticket->id}}">
      @csrf
      <div class="form-group">
    
    <textarea name="comment" class="form-control" id="textarea" rows="3"></textarea>
   </div>
      </div>
      <div class="modal-footer">
     
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit"  class="btn btn-danger">YES</button>
        
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="ticketdelete-{{$ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <form method="POST" action="{{route('ticket.destroy',$ticket->id)}}">
      @csrf
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit"  class="btn btn-danger">YES</button>
        </form>
      </div>
    </div>
  </div>
</div>
  <div class="modal fade" id="ticketassign-{{$ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="POST" action="{{route('ticket/assign/tospecificagent',$ticket->id)}}">
      @csrf
      
      <div class="modal-header">
      
      <input type="hidden" name="tokensend" value="{{$ticket->id}}">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <b style="color:red;"> ARE YOU WANTS TO Assign THIS ?</b>
      <div class="form-group">
    <label >Department select</label>
      <select id="departmentid" name="department_id" class="departmentid form-control" >
  <option value="0"></option>

   @foreach($departments as $department)
   
   
   <option id="" value="{{ $department->id }}" {{($ticket->departments->id==$department->id) ? 'selected': '' }}>{{ $department->name }}</option>
   
   @endforeach
   </select>
   </div>
      
   <div class="form-group">
    <label >User select</label>
    <select id="user_id" name="user_id" class="user_id form-control">
 </select>
   </div>
   <div class="form-group">
    <label >message send</label>
    <textarea name="adminmessage" class="form-control" id="textarea" rows="3"></textarea>
   </div>
 
   </div>
      <div class="modal-footer">
      
      
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit"  class="btn btn-info">YES</button>
        
      </div>
    </form>
    </div>
  </div>
  </div>
  
    <tr>
      <th scope="row">{{++$key}}</th>
      <td>{{$ticket->ticket_generator}}</td>
      <td class="status">{{$ticket->status}}</td>
      
      <td>{{$ticket->users->name}}</td>
      <td>{{$ticket->departments->name}}</td>
      <td>{{$ticket->assignto}}</td>
      <td><a class="btn btn-primary" href="{{ route('ticket.show',$ticket->id) }}">show</a>
     <a class="btn btn-primary" href="{{ route('ticket.edit',$ticket->id) }}">edit</a>
     <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ticketdelete-{{$ticket->id}}">
 Delete
</button>
@role('Admin')
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#ticketassign-{{$ticket->id}}">
Assign to
</button>
@endrole
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#comment-{{$ticket->id}}">
 Comment
</button>
</td>
   </tr>

   @endforeach
   
  </tbody>


</table>
<script type="text/javascript">
    $(document).ready(function() {
    $('#ticketTable').DataTable();
} );

</script>
<script>
 $(document).ready(function () {
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
                                 
		                                    $('.departmentid').on('change', function () {
                                   
                                        var iddepartment= this.value;

                                      
                                        $('.user_id').html('');
                                        

                                      $.ajax({
                                            url:"{{url('assigntoagent')}}" ,
                                            method:'POST',
                                        data:{
                                         idfordepartment:iddepartment,
                                    
                                           },
                                           dataType:'json',
                                       success:function(result){
                                         $('.user_id').html('<option value="">-- Select User--</option>');
                        $.each(result, function (key, value) {
                            $(".user_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                                         }


                                }) ;
                                 
                               
                                    
            });
          });
          

          $('.status:contains("pending")').css('color', 'yellow');
$('.status:contains("closed")').css('color', 'red');
$('.status:contains("open")').css('color', 'green');
   </script>   
 

@endsection
