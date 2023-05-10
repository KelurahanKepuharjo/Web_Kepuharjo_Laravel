<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_surat;

class PengajuanController extends Controller
{
    public function surat_masuk()
    {
        if (session('hak_akses') == 'admin') {
            $pengajuan = new pengajuan_surat();
            $data = $pengajuan->pengajuan()
                ->where('pengajuan_surats.status', '=', 'Disetujui RW')
                ->get();
        } elseif (session('hak_akses') == 'RT') {
            $RT = session('rt');
            $RW = session('rw');
            $pengajuan = new pengajuan_surat();
            $data = $pengajuan->pengajuan()
                ->where('pengajuan_surats.status', '=', 'Diajukan')
                ->where('master_kks.RT', '=', $RT)
                ->where('master_kks.RW', '=', $RW)
                ->get();
        } elseif (session('hak_akses') == 'RW') {
            $RW = session('rw');
            $pengajuan = new pengajuan_surat();
            $data = $pengajuan->pengajuan()
                ->where('pengajuan_surats.status', '=', 'Disetujui RT')
                ->where('master_kks.RW', '=', $RW)
                ->get();
        }

        return view('surat_masuk', compact('data'));
    }

    public function surat_ditolak()
    {
        if (session('hak_akses') == 'RT') {
            $RT = session('rt');
            $RW = session('rw');
            $pengajuan = new pengajuan_surat();
            $data = $pengajuan->pengajuan()
                ->where('pengajuan_surats.status', '=', 'Ditolak RT')
                ->where('master_kks.RT', '=', $RT)
                ->where('master_kks.RW', '=', $RW)
                ->get();
        } elseif (session('hak_akses') == 'RW') {
            $RW = session('rw');
            $hak_akses = session('hak_akses');
            $pengajuan = new pengajuan_surat();
            $data = $pengajuan->pengajuan()
                ->where('pengajuan_surats.status', '=', 'Ditolak RW')
                ->where('master_kks.RW', '=', $RW)
                ->get();
        }

        return view('surat_ditolak', compact('data'));
    }

    public function surat_selesai()
    {
        if (session('hak_akses') == 'admin') {
            $pengajuan = new pengajuan_surat();
            $data = $pengajuan->pengajuan()
                ->where('pengajuan_surats.status', '=', 'Selesai')
                ->get();

        } elseif (session('hak_akses') == 'RT') {
            $RT = session('rt');
            $RW = session('rw');
            $pengajuan = new pengajuan_surat();
            $data = $pengajuan->pengajuan()
                ->where('master_kks.RT', '=', $RT)
                ->where('master_kks.RW', '=', $RW)
                ->where('pengajuan_surats.status', '=', 'Disetujui RT')
                ->orWhere('pengajuan_surats.status', '=', 'Disetujui RW')
                ->orWhere('pengajuan_surats.status', '=', 'Selesai')
                ->get();

        } elseif (session('hak_akses') == 'RW') {
            $RW = session('rw');
            $pengajuan = new pengajuan_surat();
            $data = $pengajuan->pengajuan()
                ->where('master_kks.RW', '=', $RW)
                ->Where('pengajuan_surats.status', '=', 'Disetujui RW')
                ->orWhere('pengajuan_surats.status', '=', 'Selesai')
                ->get();

        }

        return view('surat_selesai', compact('data'));
    }
}
