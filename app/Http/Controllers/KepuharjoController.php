<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;


class KepuharjoController extends Controller
{
    public function index()
    {
        session()->flush();
        session()->save();

        return view('index');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function tentang()
    {
        return view('tentang');
    }

    public function updateprofil()
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);
        dd($imageName);
    }

    public function logout()
{
    Session::flush();
    return redirect()->route('login');
}
}
