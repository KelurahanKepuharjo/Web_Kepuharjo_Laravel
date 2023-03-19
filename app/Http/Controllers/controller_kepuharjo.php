<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class controller_kepuharjo extends Controller
{
    public function index(){
        return view('index');
    }

    public function login(){
        return view('login');
    }

    // public function postlogin(Request $request){
    //     if(Auth::attempt($request->only('nama', 'password'))){
    //     return redirect('/dashboard');
    //     }
    // }

    public function customLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        dd('Berhasil Login');
        // $credentials = $request->only('name', 'password');
        // if (Auth::attempt($credentials)) {
        //     return redirect()->intended('/dashboard')
        //                 ->withSuccess('Signed in');
        // }

        // return redirect("login")->withSuccess('Login details are not valid');
    }

    public function dashboard(){
        return view('dashboard');
    }

}
