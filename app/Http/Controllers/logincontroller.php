<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        // dd('success');
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $user = DB::table('master_masyarakats')
        ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
        ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
        ->where('master_masyarakats.nik', '=', $request->username)
        ->first();

        // $hashedPassword = Hash::make($request->password);
        // dd($hashedPassword);
        // dd($user->password);

        if ($user) {
            if (Hash::check($request->password, $user->password) ) {
                // dd($user);
                // Auth::login($user);
                $session = [
                    'nama' => $user->nama_lengkap,
                    'hak_akses' =>  $user->role,
                    'rt' =>  $user->rt,
                    'rw' =>  $user->rw,
                ];
                session()->put($session);
                return redirect('dashboard');
                # code...
            }
        }
    }
}


//password hash

// use Illuminate\Support\Facades\Hash;

// $password = 'password123';
// $hashedPassword = Hash::make($password);

// if (Hash::check($password, $hashedPassword)) {
//     // Password cocok
// } else {
//     // Password tidak cocok
// }
