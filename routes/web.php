<?php
  
use Illuminate\Support\Facades\Route;
  use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\relationController;
use App\Http\Controllers\TicketController;

  
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  
Route::get('/', function () {
    return view('welcome');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//profile route

Route::get('user/profile',[UserController::class,'userProfile'])->name('user.profile');
Route::post('user/profile/edit/{id}',[UserController::class,'userProfileEdit'])->name('profile/update');
//Ticket route
Route::get('ticket/create',[TicketController::class,'ticketGenerator'])->name('ticketcreate');
Route::post('ticket/store',[TicketController::class,'ticketStore'])->name('ticket-store');
Route::get('ticket/index',[TicketController::class,'ticketIndex'])->name('ticket-index');
Route::get('ticket/show/{id}',[TicketController::class,'ticketShow'])->name('ticket.show');
Route::get('ticket/edit/{id}',[TicketController::class,'ticketEdit'])->name('ticket.edit');
Route::post('ticket/update/{id}',[TicketController::class,'ticketUpdate'])->name('ticket.update');
Route::post('ticket/destroy/{id}',[TicketController::class,'ticketDestroy'])->name('ticket.destroy');
Route::post('assigntoagent',[TicketController::class,'ticketAssign'])->name('assigntospecificagent');
Route::post('ticketassigntospecific/{id}',[TicketController::class,'ticketAssignSpecific'])->name('ticket/assign/tospecificagent');
Route::post('ticketcomment/{id}',[TicketController::class,'ticketComment'])->name('ticket.comment');

//end ticket route 
// department route
Route::get('department/create',[DepartmentController::class,'DepartmentCreate'])->name('departmentcreate');
Route::post('department/store',[DepartmentController::class,'DepartmentStore'])->name('departmentStore');
Route::get('department/view',[DepartmentController::class,'departmentView'])->name('departmentView');
 Route::get('department/edit/{id}',[DepartmentController::class,'DepartmentEdit'])->name('department.edit');
Route::post('department/update/{id}',[DepartmentController::class,'DepartmentUpdate'])->name('departmentUpdate');
 Route::get('departmentshow/{id}',[DepartmentController::class,'DepartmentShow'])->name('department.show');
 Route::get('department/destroy/{id}',[DepartmentController::class,'departmentDestroy'])->name('department.destroy');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::controller(relationController::class)->group(function () {


    Route::get('relation', 'oneToOne');
    Route::get('relationTicket', 'oneToMany');
    Route::get('checkUser', 'checkUser');
    Route::get('singleRecord', 'singleRecord');
    Route::get('columnValue', 'columnValue');
    Route::get('chunk', 'chunk');
    Route::get('aggregrate', 'aggregrate');
});