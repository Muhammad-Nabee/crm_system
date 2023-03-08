<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Function_;

class relationController extends Controller
{
    public function oneToOne(){
            $users= User::with('department')->get();
            dd($users);
    }

    public function oneToMany(){
        $department= Department::all();
        // $tickket = Ticket::whereBelongsTo($department)->get();
            // $tickket=Ticket::all();
       $tickket = Ticket::with('department')->first();

       dd($tickket);
    }
    public function checkUser(){
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            echo $user->name;
            // dd($user->name);
          
        }
    }
    public function singleRecord(){
       // $user = DB::table('users')->where('id', 38)->first();
        //  dd($user->department_id);
       $email = DB::table('users')->where('name', 'awais')->value('email');
      dd($email);

    }
    //Retrieving A List Of Column Values
    public function columnValue(){
        $name = DB::table('users')->pluck('name');
 
foreach ($name as $name) {
    echo $name ."==";
}
    }
    public function chunk(){
       $ch= DB::table('users')->where('department_id', 2)
    ->chunkById(2, function ($users) {
        foreach ($users as $user) {
        $use=    DB::table('users')
                ->where('id', $user->id)
                ->update(['department_id' =>1]);
                
        }
       
    });
    dd($ch);

 }
 public function aggregrate(){
    //$users = DB::table('users')->count();
    //$users= DB::table('users')->max('id');

    // $users = DB::table('users')
    //             ->where('department_id', 1)
    //             ->avg('id');


//     if ($users=DB::table('users')->where('email', 'admin@gmail.com')->exists()) {
//         dd($users);
   
//  }
// $users = DB::table('users')
//             ->select('name', 'email as user_email')
//             ->get();

            // $users = DB::table('users')->select('name')->distinct()->get();


            // $users = DB::table('users')
            //  ->select(DB::raw('count(*) as user_count, department_id'))
            //  ->where('department_id', '<',4)
            //  ->groupBy('department_id')->get();
            

            // dd($users);


            // $users = DB::table('users')
            //     ->whereRaw('id > IF(name = "awais", ?,30)', [39])
            //     ->get();
            //     dd($users);

             $tickets = DB::table('tickets')
                 ->whereRaw('id < IF(user_id= 35, ?, 59)', [40])
                 ->get();



                // $tickets=Ticket::where('id',56)->where('user_id',1)->get();
                 dd($tickets);
}


}