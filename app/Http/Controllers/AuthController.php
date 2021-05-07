<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
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
}
