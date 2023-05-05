<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    public function surat_masuk()
    {
        if (session('hak_akses')=='admin') {
            $hak_akses = session('hak_akses');
            $data = DB::table('master_kks')
            ->join('master_masyarakats', 'master_kks.id', '=', 'master_masyarakats.id')
            ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('pengajuan_surats', 'master_akuns.id', '=', 'pengajuan_surats.id')
            ->join('master_surats', 'pengajuan_surats.id_surat', '=', 'master_surats.id_surat')
            ->where('pengajuan_surats.status', '=', 'Disetujui RW')
            ->get();
            return view('surat_masuk', compact('data'));

        }elseif(session('hak_akses')=='RT'){
            $RT = session('rt');
            $RW = session('rw');
            $hak_akses = session('hak_akses');
            $data = DB::table('master_kks')
            ->join('master_masyarakats', 'master_kks.id', '=', 'master_masyarakats.id')
            ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('pengajuan_surats', 'master_akuns.id', '=', 'pengajuan_surats.id')
            ->join('master_surats', 'pengajuan_surats.id_surat', '=', 'master_surats.id_surat')
            ->where('pengajuan_surats.status', '=', 'Diajukan')
            ->where('master_kks.RT','=', $RT)
            ->where('master_kks.RW','=', $RW)
            ->where('master_akuns.role','=', $hak_akses)
            ->get();
            return view('surat_masuk', compact('data'));
        }elseif(session('hak_akses')=='RW')
            $RW = session('rw');
            $hak_akses = session('hak_akses');
            $data = DB::table('master_kks')
            ->join('master_masyarakats', 'master_kks.id', '=', 'master_masyarakats.id')
            ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('pengajuan_surats', 'master_akuns.id', '=', 'pengajuan_surats.id')
            ->join('master_surats', 'pengajuan_surats.id_surat', '=', 'master_surats.id_surat')
            ->where('pengajuan_surats.status', '=', 'Disetujui RT')
            ->where('master_kks.RW','=', $RW)
            ->where('master_akuns.role','=', $hak_akses)
            ->get();
            return view('surat_masuk', compact('data'));
    }

    public function surat_ditolak()
    {
       if(session('hak_akses')=='RT'){
            $RT = session('rt');
            $RW = session('rw');
            $hak_akses = session('hak_akses');
            $data = DB::table('master_kks')
            ->join('master_masyarakats', 'master_kks.id', '=', 'master_masyarakats.id')
            ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('pengajuan_surats', 'master_akuns.id', '=', 'pengajuan_surats.id')
            ->join('master_surats', 'pengajuan_surats.id_surat', '=', 'master_surats.id_surat')
            ->where('pengajuan_surats.status', '=', 'Ditolak RT')
            ->where('master_kks.RT','=', $RT)
            ->where('master_kks.RW','=', $RW)
            ->where('master_akuns.role','=', $hak_akses)
            ->get();
            return view('surat_ditolak', compact('data'));
        }elseif(session('hak_akses')=='RW')
            $RW = session('rw');
            $hak_akses = session('hak_akses');
            $data = DB::table('master_kks')
            ->join('master_masyarakats', 'master_kks.id', '=', 'master_masyarakats.id')
            ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('pengajuan_surats', 'master_akuns.id', '=', 'pengajuan_surats.id')
            ->join('master_surats', 'pengajuan_surats.id_surat', '=', 'master_surats.id_surat')
            ->where('pengajuan_surats.status', '=', 'Ditolak RW')
            ->where('master_kks.RW','=', $RW)
            ->where('master_akuns.role','=', $hak_akses)
            ->get();
            return view('surat_ditolak', compact('data'));
    }

    public function surat_selesai()
    {
        if (session('hak_akses')=='admin') {
            $hak_akses = session('hak_akses');
            $data = DB::table('master_kks')
            ->join('master_masyarakats', 'master_kks.id', '=', 'master_masyarakats.id')
            ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('pengajuan_surats', 'master_akuns.id', '=', 'pengajuan_surats.id')
            ->join('master_surats', 'pengajuan_surats.id_surat', '=', 'master_surats.id_surat')
            ->where('pengajuan_surats.status', '=', 'Selesai')
            ->get();
            return view('surat_selesai', compact('data'));

        }elseif(session('hak_akses')=='RT'){
            $RT = session('rt');
            $RW = session('rw');
            $hak_akses = session('hak_akses');
            $data = DB::table('master_kks')
            ->join('master_masyarakats', 'master_kks.id', '=', 'master_masyarakats.id')
            ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('pengajuan_surats', 'master_akuns.id', '=', 'pengajuan_surats.id')
            ->join('master_surats', 'pengajuan_surats.id_surat', '=', 'master_surats.id_surat')
            ->where('master_kks.RT','=', $RT)
            ->where('master_kks.RW','=', $RW)
            ->where('master_akuns.role','=', $hak_akses)
            ->where('pengajuan_surats.status', '=', 'Disetujui RT')
            ->orWhere('pengajuan_surats.status', '=', 'Disetujui RW')
            ->orWhere('pengajuan_surats.status', '=', 'Selesai')
            ->get();
            return view('surat_selesai', compact('data'));
        }elseif(session('hak_akses')=='RW')
            $RW = session('rw');
            $hak_akses = session('hak_akses');
            $data = DB::table('master_kks')
            ->join('master_masyarakats', 'master_kks.id', '=', 'master_masyarakats.id')
            ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('pengajuan_surats', 'master_akuns.id', '=', 'pengajuan_surats.id')
            ->join('master_surats', 'pengajuan_surats.id_surat', '=', 'master_surats.id_surat')
            ->where('master_kks.RW','=', $RW)
            ->where('master_akuns.role','=', $hak_akses)
            ->orWhere('pengajuan_surats.status', '=', 'Disetujui RW')
            ->orWhere('pengajuan_surats.status', '=', 'Selesai')
            ->get();
            return view('surat_selesai', compact('data'));
    }
}
