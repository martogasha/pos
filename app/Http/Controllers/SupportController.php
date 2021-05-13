<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupportController extends Controller
{
    public function index(){
        $users = User::all();
        return view('support.index',[
            'users'=>$users
        ]);
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
}
