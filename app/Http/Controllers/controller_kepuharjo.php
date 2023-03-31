<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\master_kks;
use Redirect;

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

    public function simpanmasterkk(Request $request)
    {
        $this->validate($request, [
            'no_kk' => 'unique:master_kks'
        ]);

            $data = new master_kks();
            $data->no_kk = $request->nokk;
            $data->nama_kepala_keluarga = $request->kepala_keluarga;
            $data->alamat = $request-> alamatkk;
            $data->rt = $request->rt;
            $data->rw = $request->rw;
            $data->kode_pos = $request->kdpos;
            $data->kelurahan = $request->kel;
            $data->kecamatan = $request->kec;
            $data->kabupaten = $request->kab;
            $data->provinsi = $request->prov;
            $data->kk_tgl = $request->tglkk;
        $data->save();
        return Redirect('masterkk');


    }


    public function dashboard(){
        return view('dashboard');
    }

    public function buttons(){
        return view('pages/ui-features/buttons');
    }

    public function suratmasuk(){
        return view('surat_masuk');
    }

    public function suratditolak(){
        return view('surat_ditolak');
    }

    public function suratselesai(){
        return view('surat_selesai');
    }

    public function masteruser(){
        return view('master_user');
    }

    public function master_rtrw(){
        return view('master_rtrw');
    }

    public function master_kk(){
        $data = master_kks::all();
        return view('master_kk', compact('data'));
    }


    public function berita(){
        return view('berita');
    }

    public function tentang(){
        return view('tentang');
    }
}