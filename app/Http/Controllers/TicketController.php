<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Notificed;
use App\Notifications\FromAdminSide;
use App\Notifications\FromSpecificAgent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function ticketGenerator(){

        $department= Department::all();
        return view('Ticket.create')->with(compact('department'));
   
}
public function ticketStore(Request $request){
    $users=User::all();

    
  
   
  $ticket=  Ticket::create(array(

        'ticket_generator' => $request->ticket,
        'status' => 'open',
        'department_id' =>$request->department_id,
        'user_id' =>auth()->user()->id,
        )); 
  
    
   foreach($users as $user){
    if($user->hasRole('Admin')){
        (Notification::send($user, new Notificed($ticket)));
    }
    
}

    return redirect()->route('ticket-index')->with('success','User created successfully',compact('ticket'));

}
public function ticketIndex(){
    $tickets=Ticket::with('users','departments')->get();
    $departments=Department::all();
   
    
    return view('Ticket.index')->with(compact('tickets','departments'));
}

public function ticketShow($id){
    //code
    $ticket=Ticket::find($id);
    return view('Ticket.show')->with(compact('ticket'));
}
public function  ticketEdit($id){
    //code
  
    $departments=Department::all();
    
    $tickets=Ticket::find($id);
    
    return view('Ticket.edit',compact('tickets','departments'));
    }
public function  ticketUpdate(Request $request,$id){
//code

$ticket=  Ticket::find($id);
$ticket->ticket_generator=$request->ticket;
$ticket->user_id=auth()->user()->id;
$ticket->department_id=$request->department_id;

$ticket->status='open';
$ticket->assignto=0;
$ticket->save();
return redirect()->route('ticket-index');

}
public function  ticketDestroy($id){
    
$ticket=Ticket::find($id);

$ticket->delete();
return redirect()->back();
}
public function ticketAssign(Request $request){
    
    $users=User::WHERE('department_id',$request->idfordepartment)->get(['name','id']);
    return response()->json($users);


}
public function ticketAssignSpecific(Request $request,$id){
   
    $ticket=Ticket::find($id);
    
    $ticket->status='pending';
    $ticket->assignto=$request->user_id;
    $ticket->comments=$request->adminmessage;
    $ticket->save();
        $users=User::where('id',$request->user_id)->get();
        
        (Notification::send($users, new FromAdminSide($ticket)));
    
return redirect()->back()->with('success','User created successfully',compact('users','ticket'));
}
public function ticketComment(Request $request,$id){
  
    $tickets=Ticket::find($id);
  $tickets->comments=$request->comment;
   $tickets->status='Closed';
   
   $tickets->save();
   
   $users=User::all();
 
   $specific=['THANKS  ALL PROBLEM IS SOLVED'];
   foreach($users as $user){
  
    if($user->hasRole('Admin') || $user->id == $tickets->user_id){

        (Notification::send($user, new FromSpecificAgent($specific)));
      
    }
    
    
    return redirect()->back()->with('success','User created successfully',compact('user','tickets'));

}

}
}