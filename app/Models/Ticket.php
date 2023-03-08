<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Department;
class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'ticket_generator','status','department_id','user_id','comment',
    ];
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function department(){
       // return $this->belongsTo(Department::class,'department_id','id');
        return $this->belongsToMany(Department::class,'department_tickets');
        
    }
    
}
