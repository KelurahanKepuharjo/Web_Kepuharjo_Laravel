<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');


        $users = DB::table('master_masyarakats')
       ->join('master_akuns', 'master_akuns.id_masyarakats', '=', 'master_masyarakats.id_masyarakats')
       ->get();
    //    ->where('master_masyarakats.id_masyarakat', $username)
    //    ->and('master_akuns')
    //     ->first();

        // $user = User::where('username', $username)->first();

        if ($users->nik == $username &&  $users->password == $password) {
            // Jika autentikasi berhasil, redirect ke halaman dashboard.
            return redirect()->intended('dashboard');
        }
        // Jika autentikasi gagal, kembali ke halaman login dengan error message.
        return redirect('/login')->with('error', 'Username atau password salah.');
    }
}
