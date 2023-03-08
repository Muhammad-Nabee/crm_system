<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function DepartmentCreate(){
        return view('Department.create');
    }
    public function departmentStore(Request $request){
        request()->validate([
            'name' => 'required',
            
            
        ]);
        $department= new Department;
        $department->name=$request->name;
        $department->save();
        return redirect()->route('departmentView')->with('success','Department created successfully');
    }

    public function departmentView(){
        
        $department=Department::all();
        return view('Department.index',compact('department'));
    }
    public function departmentShow($id){
        $department=Department::find($id);
     
        return view('Department.show')->with(compact('department'));
    }
    public function departmentDestroy($id){
      
        $department=Department::find($id);
       
        $department->delete();
    
        return redirect()->route('departmentView')
                        ->with('success','Department deleted successfully');
    }
    public function departmentEdit($id){
        $department= Department::find($id);
      
        return view('Department.edit',compact('department'));
    }
    public function DepartmentUpdate(Request $request,$id){
     
        request()->validate([
            'name' => 'required',
            
            
        ]);
        $department=Department::find($id);
        $department->name=$request->name;
        $department->save();
        return redirect()->route('departmentView')->with('success','Department update successfully');

    }
}
