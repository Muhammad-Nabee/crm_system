<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department=Department::all();
        $roles = Role::all()->except(Auth()->user()->hasRole('Admin'))->pluck('name','name');

        return view('users.create',compact('roles','department'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->department_id=$request->department_name;
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $department=Department::all();
      
        $roles = Role::all()->except(Auth()->user()->hasRole('Admin'))->pluck('name','name');
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole','department'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }



    public function userProfile(){
        $user=User::where('id',Auth()->user()->id)->get();
        
        return view('users.profile',compact('user'));
       
    }
    public function userProfileEdit(Request $request,$id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
           
        ]);
        $user=User::find($id);
        if($request->old_img!=null){

            $this->validate($request, [
              'old_img' => 'image|mimes:jpg,png,jpeg|max:5000',
            ]);

          }if($request->old_img!=null){

                $file =$request->old_img;
                $fileName = time().'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('upload/userimg');
                if(File::exists(public_path('upload/userimg/'.$user->image))){
                    File::delete(public_path('upload/userimg/'.$user->image));
                }else{
                    ('File does not exists.');
                }
                $file->move($destinationPath,$fileName);
                $Image = $fileName;
                
              
            }
         
          else{

                 $Image =$user->image;

          }
      
       
        
        if(!empty($request->password)){ 
            $user->password= Hash::make($request->password);
        }else{
            $user->password=Auth()->user()->password;
        }
             
        
        $user->name=$request->name;
        $user->email=$request->email;
        $user->image=$Image;
        $user->save();
       
        return redirect()->back()->with('success','User updated successfully');


    }
}

