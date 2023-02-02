<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckLoginController extends Controller
{   
    public function loginget(){
        if(Auth::check()){
            return redirect(url('admin/users'));
        }
        return view('backend.Auth.Login');

    }
    public function loginpost(){
        $email = request("email");// <=> $email = Request::get("email");
        $password = request("password");
        if(Auth::Attempt(["email"=>$email,"password"=>$password])){
            if( Auth::user()->level == 1 || Auth::user()->level == 2){
                return redirect(url('admin/users'));
            }else{
                return redirect(url('admin/tasks'));
            }   
        }else{
            return redirect(url("login?notify=invalid"));
        }
            
    }
    public function logout(){
        Auth::logout();//Auth là đối tượng có sẵn của laravel
	    return redirect(url("login"));
    }
}
