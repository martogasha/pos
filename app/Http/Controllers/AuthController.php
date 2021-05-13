<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function loginUser(Request $request){
        $user = User::where('email',$request->email)->first();

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            if ($user->role ==0){
                return redirect(url('support'));
            }
            else{
                return redirect(url('dashboard'));
            }
        }
        else{
            return redirect()->back()->with('error', 'CREDENTIALS DOES NOT MATCH');
        }    }
    public function register(Request $request){
        $user = User::create([
           'first_name' => $request->input('first_name'),
           'last_name' => $request->input('last_name'),
           'phone' => $request->input('phone'),
           'business_name' => $request->input('business_name'),
           'business_type' => $request->input('business_type'),
           'role' => $request->input('role'),
           'password' => Hash::make($request->password),
        ]);
        return view('auth.login')->with('success','Registered successfully');
    }
    public function profile(){
        return view('backend.profile');
    }
    public function updateUserinfo(Request $request){
        if ($request->ajax()){
            $update = User::find($request->user_id);
            $update->first_name = $request->first_name;
            $update->last_name = $request->last_name;
            $update->phone = $request->phone;
            $update->email = $request->email;
            $update->role = $request->role;
            $update->password = Hash::make($request->password);
            $update->save();
        }
    }
}
