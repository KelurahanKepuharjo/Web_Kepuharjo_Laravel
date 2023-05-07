<?php

namespace App\Http\Controllers;
use App\Models\pengajuan_surat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KepuharjoController extends Controller
{
    public function index()
    {
        session()->flush();
        session()->save();

        return view('index');
    }

    public function dashboard()
    {
        if (session('hak_akses') == 'admin') {
            $suratmasuk = DB::table('pengajuan_surats')
                ->where('pengajuan_surats.status', '=', 'Selesai')
                ->count();
            $suratselesai = DB::table('pengajuan_surats')
                ->where('pengajuan_surats.status', '=', 'Disetujui RW')
                ->count();
            $suratditolak = '';
            return view('dashboard', ['suratmasuk' => $suratmasuk], ['suratselesai' => $suratselesai], ['suratditolak' => $suratditolak]);

        } elseif (session('hak_akses') == 'RT') {
            $RT = session('rt');
            $RW = session('rw');
            $pengajuan = new pengajuan_surat();
            $suratmasuk = $pengajuan->pengajuan()
                ->where('master_kks.RT', '=', $RT)
                ->where('master_kks.RW', '=', $RW)
                ->where('pengajuan_surats.status', '=', 'Diajukan')
                ->count();
            $pengajuan = new pengajuan_surat();
            $suratditolak = $pengajuan->pengajuan()
                ->where('master_kks.RT', '=', $RT)
                ->where('master_kks.RW', '=', $RW)
                ->where('pengajuan_surats.status', '=', 'Ditolak RT')
                ->count();
            $pengajuan = new pengajuan_surat();
            $suratselesai = $pengajuan->pengajuan()
                ->where('master_kks.RT', '=', $RT)
                ->where('master_kks.RW', '=', $RW)
                ->where('pengajuan_surats.status', '=', 'Disetujui RT')
                ->orWhere('pengajuan_surats.status', '=', 'Disetujui RW')
                ->orWhere('pengajuan_surats.status', '=', 'Selesai')
                ->count();
            return view('dashboard', ['suratmasuk' => $suratmasuk, 'suratselesai' => $suratselesai, 'suratditolak' => $suratditolak]);
        } elseif (session('hak_akses') == 'RW') {
            $RW = session('rw');
            $pengajuan = new pengajuan_surat();
            $suratmasuk = $pengajuan->pengajuan()
                ->where('master_kks.RW', '=', $RW)
                ->where('pengajuan_surats.status', '=', 'Disetujui RT')
                ->count();
            $pengajuan = new pengajuan_surat();
            $suratditolak = $pengajuan->pengajuan()
                ->where('master_kks.RW', '=', $RW)
                ->where('pengajuan_surats.status', '=', 'Ditolak RW')
                ->count();
            $pengajuan = new pengajuan_surat();
            $suratselesai = $pengajuan->pengajuan()
                ->where('master_kks.RW', '=', $RW)
                ->Where('pengajuan_surats.status', '=', 'Disetujui RW')
                ->orWhere('pengajuan_surats.status', '=', 'Selesai')
                ->count();
            return view('dashboard', ['suratmasuk' => $suratmasuk, 'suratselesai' => $suratselesai, 'suratditolak' => $suratditolak]);
        }
    }

    public function tentang()
    {
        return view('tentang');
    }

    public function updateprofil()
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);
        dd($imageName);
    }

    public function logout()
    {
        Session::flush();

        return redirect()->route('login');
    }
}
