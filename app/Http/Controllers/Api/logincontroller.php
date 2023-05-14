<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class logincontroller extends Controller
{
    public function login()
    {
        return view('login');
    }
}
