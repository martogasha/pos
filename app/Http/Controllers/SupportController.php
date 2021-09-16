<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SupportController extends Controller
{
    public function index(){
        if (Auth::check()){
            $users = User::where('role','!=',5)->get();
            return view('support.index',[
                'users'=>$users
            ]);
        }
        else{
            return redirect(url('login'));

        }

    }
    public function clients(){
        if (Auth::check()){
            $users = User::where('role',5)->get();
            return view('support.customers',[
                'users'=>$users
            ]);
        }
        else{
            return redirect(url('login'));

        }

    }
    public function addUser(Request $request){
        if ($request->ajax()){
            $output="";
            $addUser = User::create([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'role'=>$request->role,
                'password'=>Hash::make('password'),
            ]);
        }
    }
    public function editUser(Request $request){
        if ($request->ajax()){
            $output = "";
            $getUser = User::find($request->user_id);
        }
        $output = '
           <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit <b>'.$getUser->first_name.' '.$getUser->last_name.'</b> Details </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <input type="text" class="form-control" value="'.$getUser->first_name.'" id="first" aria-describedby="emailHelp" placeholder="Enter Service Offered">
                    </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input type="text" class="form-control" value="'.$getUser->last_name.'" id="last" aria-describedby="emailHelp" placeholder="Enter Service Offered">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="text" class="form-control" value="'.$getUser->email.'" id="userEmail" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Phone Number</label>
                        <input type="text" class="form-control" value="'.$getUser->phone.'" id="userPhone" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <label>User Role *</label>
                        <select name="type" id="userRole" class="form-control">
                            <option value="1">User</option>
                            <option value="0">Admin</option>
                        </select>
                    </div>
                    <input type="hidden" value="'.$getUser->id.'" id="userId">
            </div>
        ';
        return response($output);
    }
    public function passwordReset(Request $request){
        if ($request->ajax()){
            $reset = User::find($request->user_id);
            $reset->password = Hash::make('password');
            $reset->save();
        }
    }
    public function postEdit(Request $request){
        if ($request->ajax()){
            $edit = User::find($request->user_id);
            $edit->first_name = $request->first_name;
            $edit->last_name = $request->last_name;
            $edit->email = $request->email;
            $edit->phone = $request->phone;
            $edit->role = $request->role;
            $edit->save();
        }
    }
    public function deleteUser(Request $request){
        if ($request->ajax()){
            $delete = User::find($request->user_id);
            $delete->delete();
        }
    }
}
