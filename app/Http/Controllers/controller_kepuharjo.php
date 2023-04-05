<?php

namespace App\Http\Controllers;

use App\Models\berita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\master_kks;
use App\Models\master_rtrw;
use App\Models\master_masyarakat;


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

    public function edit(Request $request, $id){
        $data= master_kks::where('no_kk', $id)->first();
        return view('master_kk-edit', compact('data'));
    }

    public function update(Request $request, $id){
        $data = master_kks::where('no_kk', $id)->first();
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

    public function hapus(Request $request, $id){
        $data = master_kks::where('no_kk', $id);
        $data -> delete();
        return Redirect('masterkk');
    }

    public function simpanmasterrtrw(Request $request)
    {
        $this->validate($request, [
            // 'no_kk' => 'unique:master_kks'
        ]);

            $data = new master_rtrw();
            $data->nik = $request->nik;
            $data->nama_lengkap = $request->nama_lengkap;
            $data->alamat = $request-> alamatkk;
            $data->no_hp = $request-> no_hp;
            $data->rt = $request->rt;
            $data->rw = $request->rw;
        $data->save();
        return Redirect('masterrtrw');
    }

    public function simpanmasteruser(Request $request)
    {
        $this->validate($request, [
            // 'no_kk' => 'unique:master_kks'
        ]);

            $data = new master_masyarakat();
            $data->nik = $request->nik;
            $data->nama_lengkap = $request->nama_lengkap;
            $data->tempat_lahir = $request-> tempat_lahir;
            $data->tgl_lahir = $request-> tgl_lahir;
            $data->jenis_kelamin = $request->jenis_kelamin;
            $data->pekerjaan = $request->pekerjaan;
        $data->save();
        return Redirect('masteruser');
    }

    public function simpanmasterberita(Request $request)
    {
        $this->validate($request, [
            // 'no_kk' => 'unique:master_kks'
        ]);


            $data = new berita();
            $data->judul = $request->judul;
            $data->sub_title = $request->subtitle;
            $data->deskripsi = $request-> deskripsi;
        $data->save();
        return Redirect('berita');
    }

    public function editberita(Request $request, $id){
        $data= berita::where('id_berita', $id)->first();
        return view('berita', compact('data'));
    }

    public function updateberita(Request $request, $id){
    $data = new berita();
    $data->judul = $request->judul;
    $data->sub_title = $request->subtitle;
    $data->deskripsi = $request-> deskripsi;
    $data->save();
    return Redirect('berita');
    }

    public function hapusberita(Request $request, $id){
        $data = berita::where('id_berita', $id);
        $data -> delete();
        return Redirect('berita');
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
        $data = master_masyarakat::all();
        return view('master_user', compact('data'));
    }

    public function master_rtrw(){
        $data = master_rtrw::all();
        return view('master_rtrw', compact('data'));
    }

    public function master_kk(){
        $data = master_kks::all();
        return view('master_kk', compact('data'));
    }


    public function berita(){
        $data = berita::all();
        return view('berita', compact('data'));
    }

    public function tentang(){
        return view('tentang');
    }

    public function master_beritas(){
        $data = berita::all();
        return view('berita', compact('data'));
    }
}
