<?php

namespace App\Http\Controllers;

use App\Models\berita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\master_kks;
use App\Models\master_rtrw;
use App\Models\master_masyarakat;
use App\Models\master_surat;
use App\Models\master_akun;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Alert;


use Redirect;

class controller_kepuharjo extends Controller
{
    public function index(){
        return view('index');
    }

    public function login(){
        return view('login');
    }





    // Controller Master KK
    public function simpanmasterkk(Request $request)
    {
        try {
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
            return redirect()->back()->with('message', 'Data Berhasil ditambahkan');
        } catch (\Throwable $th) {
            echo "<script>alert('Data Gagal Ditambahkan.');window.location='masterkk';</script>";
        }
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
    // Batas Controller Master KK





    // Controller Master Masyarakat
    public function simpanmasteruser(Request $request)
    {
        $this->validate($request, [
        ]);
            $data = new master_masyarakat();
            $uuid = Str::uuid()->toString();
            $data->id_masyarakat = $uuid;
            $data->id = $request->nokk;
            $data->nik = $request->nik;
            $data->nama_lengkap = $request->nama_lengkap;
            $data->jenis_kelamin = $request->jns_kelamin;
            $data->tempat_lahir = $request-> tempat_lahir;
            $data->tgl_lahir = $request-> tgl_lahir;
            $data->agama = $request->agama;
            $data->pendidikan = $request->pendidikan;
            $data->pekerjaan = $request->pekerjaan;
            $data->golongan_darah = $request->gol_darah;
            $data->status_perkawinan = $request->status_perkawinan;
            $data->tgl_perkawinan = $request->tgl_perkawinan;
            $data->status_keluarga = $request->status_keluarga;
            $data->kewarganegaraan = $request->kewarganegaraan;
            $data->no_paspor = $request->no_paspor;
            $data->no_kitap = $request->no_kitap;
            $data->nama_ayah = $request->nama_ayah;
            $data->nama_ibu = $request->nama_ibu;
        $data->save();
        // mas/'.$request->nokk
        return Redirect('masterkkmas/'.$request->nokk);
    }

    public function updatemasteruser(Request $request, $id){
        $data = master_masyarakat::where('nik', $id)->first();
        // $data->no_kk = $request->nokk;
            $data->nik = $request->nik;
            $data->nama_lengkap = $request->nama_lengkap;
            $data->jenis_kelamin = $request->jns_kelamin;
            $data->tempat_lahir = $request-> tempat_lahir;
            $data->tgl_lahir = $request-> tgl_lahir;
            $data->agama = $request->agama;
            $data->pendidikan = $request->pendidikan;
            $data->pekerjaan = $request->pekerjaan;
            $data->golongan_darah = $request->gol_darah;
            $data->status_perkawinan = $request->status_perkawinan;
            $data->tgl_perkawinan = $request->tgl_perkawinan;
            $data->status_keluarga = $request->status_keluarga;
            $data->kewarganegaraan = $request->kewarganegaraan;
            $data->no_paspor = $request->no_paspor;
            $data->no_kitap = $request->no_kitap;
            $data->nama_ayah = $request->nama_ayah;
            $data->nama_ibu = $request->nama_ibu;
    $data->save();
    return Redirect('masterkkmas/'.$request->nokk);
    }

    public function hapusmasteruser(Request $request, $id){
            $data = master_masyarakat::where('nik', $id);
            $data -> delete();
        return Redirect('masterkkmas/'.$request->nokk);
    }

    public function ajax(Request $request){
        $nik = $request->nik;
        $results = DB::table('master_masyarakats')
        ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
        ->where('master_masyarakats.nik', 'like' , '%'.$nik.'%')->get();
        $c = count($results);
        if($c == 0){
            // jikaa data kosong
            return '<p class="text-muted">Maaf, Data tidak ditemukan</p>';
        }else{
            // jika data ada
            return view('ajaxpage')->with([
                'data' => $results
            ]);
        }
    }

    public function read(){
        return "Silahkan Melakukan Pencarian Data";
    }
    // Batas Controller Master Masyarakat





    // Controller Master RT RW
    public function simpanmasterrtrw(Request $request)
    {
        $this->validate($request, [
            // 'no_kk' => 'unique:master_kks'
        ]);
            $data = new master_akun();
            $uuid = Str::uuid()->toString();
            $data->id = $uuid;
            $data->no_hp = $request->no_hp;
            $data->password = $request->password;
            $data->role = "RW";
            $data->id_masyarakat = $request->id_masyarakat;
        $data->save();
        return Redirect('masterrtrw');
    }

    public function updatemasterrtrw(Request $request, $id){
        $data = master_rtrw::where('nik', $id)->first();
        $data->nik = $request->nik;
        $data->nama_lengkap = $request->nama_lengkap;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->rt = $request->rt;
        $data->rw = $request->rw;
        $data->save();
        return Redirect('masterrtrw');
        }

        public function hapusmasterrtrw(Request $request, $id){
            $data = master_rtrw::where('nik', $id);
            $data -> delete();
            return Redirect('masterrtrw');
        }
    // Batas Controller Master RT RW





    // Controller Master Berita
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

    public function updateberita(Request $request, $id){
        $data= berita::where('id', $id)->first();
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
    // Batas Controller Master Berita





    // Controller master Surat
    public function simpan_surat(Request $request)
    {
        $this->validate($request, [
            // 'no_kk' => 'unique:master_kks'
        ]);
            $data = new master_surat();
            $data->id_surat = $request->id_surat;
            $data->nama_surat = $request->jenis_surat;
        $data->save();
        return Redirect('mastersurat');
    }

    public function ajax_masyarakat(Request $request){
        $no_kk = $request->nokk;
        $results = DB::table('master_kks')->where('nik', 'like' , '%'.$no_kk.'%')->get();
        $c = count($results);
        if($c == 0){
            // jikaa data kosong
            return '<p class="text-muted">Maaf, Data tidak ditemukan</p>';
        }else{
            // jika data ada
            return view('ajax_pagemasyarakat')->with([
                'data' => $results
            ]);
        }
    }



    public function dashboard(){
        return view('dashboard');
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
        // $data = master_rtrw::all();
        $data = DB::table('master_masyarakats')
        ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
        ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
        // ->where('master_akuns.id','=', $id)
        ->get();
        // $reserves = DB::table('reserves')
        //                ->select(DB::raw('count(*) as reserves_count'))           
        //                ->groupBy('day')
        //                ->get();
        return view('master_rtrw', compact('data'));
    }

    public function master_kk(){
        $data = master_kks::all();
        return view('master_kk', compact('data'));
        // $masyarakat = DB::table('master_masyarakats')->get();
        // return view('master_kk', compact('masyarakat'));
    }

    public function master_kk_mas(Request $request, $id){
        $data = DB::table('master_masyarakats')
        ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
        ->where('master_kks.id','=', $id)
        ->get();
        return view('master_kk_mas', ['nomor_kk'=> $id] , compact('data'));
    }


    public function berita(){
        $data = berita::all();
        return view('berita', compact('data'));
    }

    public function master_surat(){
        $data = master_surat::all();
        return view('master_surat', compact('data'));
    }

    public function tentang(){
        return view('tentang');
    }

    public function master_beritas(){
        $data = berita::all();
        return view('berita', compact('data'));
    }
}