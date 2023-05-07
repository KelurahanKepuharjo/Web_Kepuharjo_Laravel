<?php

namespace App\Http\Controllers;

use App\Models\master_akun;
use App\Models\master_kks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers\Hash;
use Illuminate\Support\Str;

class RtController extends Controller
{
    public function master_rt(Request $request, $id)
    {
        $datartrw = DB::table('master_masyarakats')
            ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
            ->where('role', '=', 'RT')
            ->where('RW', $id)
            ->get();

        return view('master_rt', compact('datartrw'));
    }

    //Controller Master RT

    public function simpanmasterrt(Request $request)
    {
        $this->validate($request, [
            // 'no_kk' => 'unique:master_kks'
        ]);
        $data = new master_akun();
        $uuid = Str::uuid()->toString();
        $data->id = $uuid;
        $data->no_hp = $request->no_hp;
        $passwordhash = $request->password;
        $data->password = Hash::make($passwordhash);
        $data->role = 'RT';
        $data->id_masyarakat = $request->id_masyarakat;
        $data->save();

        return Redirect('masterrt');
    }

public function ajax_rt(Request $request)
{
    $nik = $request->nik;
    $results = DB::table('master_masyarakats')
        ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
        ->where('master_masyarakats.nik', 'like', '%'.$nik.'%')->get();
    $c = count($results);
    if ($c == 0) {
        // jikaa data kosong
        return '<p class="text-muted">Maaf, Data tidak ditemukan</p>';
    } else {
        // jika data ada
        return view('ajax_pagert')->with([
            'data' => $results,
        ]);
    }
}
}
