<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function masteruser()
    {
        $data = DB::table('master_masyarakats')
            ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
            ->get();

        return view('master_user', compact('data'));
    }
}
