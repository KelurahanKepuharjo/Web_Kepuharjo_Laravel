<?php

namespace App\Http\Controllers;
use App\Models\master_surat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Alert;
use Redirect;

class controller_mastersurat extends Controller
{
    //Untuk Menampilkan Data Master surat
    public function master_surat(){
        $data = master_surat::all();
        return view('master_surat', compact('data'));
    }

    // Untuk Simpan data Surat
    public function simpan_surat(Request $request)
    {
        try {
            $this->validate($request, [
                // 'no_kk' => 'unique:master_kks'
            ]);
                $data = new master_surat();
                $data->id_surat = $request->id_surat;
                $data->nama_surat = $request->surat .' '. $request->jenis_surat;
            $data->save();
            return Redirect('mastersurat');
        } catch (\Throwable $th) {
            echo "<script>alert('Maaf Simpan Gagal, ID Surat yang anda masukkan sebelumnya telah ada.');window.location='mastersurat';</script>";
        }

    }

    //Untuk Hapus Data Surat
    public function hapusmastersurat(Request $request, $id){
        // dd($id);
        $data = master_surat::where('id_surat', $id);
        $data -> delete();
        return Redirect('mastersurat');
    }

    // Untuk Update Data Surat
    public function updatesurat(Request $request, $id){
        // dd($id);
            try {
                $data = DB::table('master_surats')->where('id_surat', $id)->update([
                    // $data->nik = $request->nik,
                    'nama_surat' => $request->jenis_surat
                ]);
                return Redirect('mastersurat');

            } catch (\Throwable $th) {
            }
        }
}