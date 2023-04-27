<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controller_pengajuan_surat extends Controller
{
    public function surat_masuk(){
        //jika ada session hak akses = RT

        $data = DB::table('master_kks')
        ->join('master_masyarakats','master_kks.id','=','master_masyarakats.id')
        ->join('master_akuns','master_akuns.id_masyarakat','=','master_akuns.id_masyarakats')
        ->join('pengajuan_surats','master_akuns.id','=','pengajuan_surats.id')
        ->join('master_surats','pengajuan_surats.id_surat','=','master_surats.id_surat')
        ->where('pengajuan_surats.status','=','Diajukan')
        ->get();
        dd($data);
    }

    public function surat_ditolak(){
        $data = DB::table('master_kks')
        ->join('master_masyarakats','master_kks.id','=','master_masyarakats.id')
        ->join('master_akuns','master_akuns.id_masyarakat','=','master_akuns.id_masyarakats')
        ->join('pengajuan_surats','master_akuns.id','=','pengajuan_surats.id')
        ->join('master_surats','pengajuan_surats.id_surat','=','master_surats.id_surat')
        ->where('pengajuan_surats.status','=','Ditolak RT')
        ->get();
        dd($data);
    }

    public function surat_selesai(){
        $data = DB::table('master_kks')
        ->join('master_masyarakats','master_kks.id','=','master_masyarakats.id')
        ->join('master_akuns','master_akuns.id_masyarakat','=','master_akuns.id_masyarakats')
        ->join('pengajuan_surats','master_akuns.id','=','pengajuan_surats.id')
        ->join('master_surats','pengajuan_surats.id_surat','=','master_surats.id_surat')
        ->where('pengajuan_surats.status','=','Disetujui RT')
        ->get();
        dd($data);
    }
}
