<?php

namespace App\Http\Controllers;

use App\Models\master_akun;
use App\Models\RwaksesModal;
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

    public function simpanmasterrt(Request $request, $id)
    {
        $datacheck = DB::table('master_kks')
            ->join('master_masyarakats', 'master_kks.id', '=', 'master_masyarakats.id')
            ->join('master_akuns', 'master_akuns.id_masyarakat', 'master_masyarakats.id_masyarakat')
            ->where('master_masyarakats.nik', $request->nik)
            ->where('master_kks.rt', $request->rt)
            ->where('master_kks.rw', $request->rw)
            ->where('master_akuns.role', 'RT')
            ->first();
        if ($datacheck !== null) {
            return redirect()->back()->with('errorrt','');
        } else {
            $rt = new RwaksesModal();
            $data = $rt->Rw()
                ->where('nik', $id)
                ->first();
            if ($data) {
                if ($data->role == 'RT') {
                    return Redirect('masterrt/'.$request->rt)->with('errorrt', '');
                } elseif ($data->role == 'RW') {
                    return Redirect('masterrt/'.$request->rt)->with('errorrw', '');
                } elseif ($data->role == '4') {
                    $request->validate([
                        'no_hp' => 'required|min:10|max:13',
                        'password' => 'required|min:8|max:8'
                    ], [
                        'no_hp.required' => 'Nomor Telepon Tidak Boleh Kosong',
                        'no_hp.min' => 'Nomor Telepon Minimal 10 Angka',
                        'no_hp.max' => 'Nomor Telepon Maksimal 13 Angka',
                        'password.required' => 'Password Tidak Boleh Kosong',
                        'password.min' => 'Password Minimal 8 Karakter, Terdapat Huruf dan Angka',
                        'password.max'=> 'Password Maxsimal 8 Karakter, Terdapat Huruf dan Angka'
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

                    return Redirect('masterrt/'.$request->rt)->with('success', '');
                }
            } else {
                $data = DB::table('master_masyarakats')
                    ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
                    ->where('master_masyarakats.nik', '=', $id)
                    ->first();
                $request->validate([
                    'no_hp' => 'required|min:10|max:13',
                ], [
                    'no_hp.required' => 'Nomor Telepon Tidak Boleh Kosong',
                    'no_hp.min' => 'Nomor Telepon Minimal 10 Angka',
                    'no_hp.max' => 'Nomor Telepon Maksimal 13 Angka',
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

                return Redirect('masterrt/'.$request->rt)->with('success', '');
            }
        }
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

public function read()
{
    return 'Silahkan Melakukan Pencarian Data';
}

public function updatemasterrt(Request $request, $id)
{
    $passwordhash = $request->password;
    $pass = Hash::make($passwordhash);
    $data = DB::table('master_kks')
        ->join('master_masyarakats', 'master_masyarakats.id', '=', 'master_kks.id')
        ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
        ->where('master_masyarakats.nik', $request->nik)
        ->where('master_akuns.role', 'RT')
        ->update([
            'master_akuns.no_hp' => $request->no_hp,
            'master_akuns.password' => $pass,
        ]);

    return Redirect('masterrt/'.$request->rt)->with('successedit', '');
}
}