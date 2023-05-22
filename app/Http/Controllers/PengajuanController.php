<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_surat;
use App\Models\UpdateStatusModel;
use Illuminate\Http\Request;

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
                // dd($data);
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

    public function update_statustolak(Request $request, $id, $akses)
    {
        if ($akses == 'RT') {
            $status = 'Ditolak RT';
        } elseif ($akses == 'RW') {
            $status = 'Ditolak RW';
        }
        $updatestatus = new UpdateStatusModel();
        $data = $updatestatus->UpdateStatus()
            ->where('pengajuan_surats.id', $id)
            ->first();
        $data->update([
            'pengajuan_surats.status' => $status,
        ]);

        return redirect('/suratmasuk')->with('successedit', '');
    }

    // public function update_status(Request $request, $id, $akses)
    // {
    //     if ($akses == 'RT') {
    //         $status = 'Disetujui RT';
    //     } elseif ($akses == 'RW') {
    //         $status = 'Disetujui RW';
    //     }
    //     $updatestatus = new UpdateStatusModel();
    //     $data = $updatestatus->UpdateStatus()
    //         ->where('pengajuan_surats.id', $id)
    //         ->first();
    //     $data->update([
    //         'pengajuan_surats.status' => $status,
    //     ]);

    //     return redirect('/suratmasuk')->with('successedit', '');
    // }

    public function update_status(Request $request, $id, $akses){
        if($akses=='RT'){
            $status = 'Disetujui RT';
        } elseif ($akses=='RW') {
            $status = 'Disetujui RW';
        } elseif ($akses=='admin') {
            $status = 'Selesai';
        }
        $updatestatus = new UpdateStatusModel();
            $data = $updatestatus->UpdateStatus()
                ->where('pengajuan_surats.id', $id)
                ->first();
            $data->update([
                'pengajuan_surats.status' => $status,
            ]);

            return redirect('/suratmasuk')->with('successedit', '');
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

                // dd($data);
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
