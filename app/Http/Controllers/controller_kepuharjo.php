<?php

namespace App\Http\Controllers;

use App\Models\master_akun;
use App\Models\master_kks;
use App\Models\master_masyarakat;
use App\Models\master_rtrw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers\Hash;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Hash;

use Redirect;

class controller_kepuharjo extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function superadmin()
    {
        return view('superadmin');
    }

    public function login()
    {
        return view('login');
    }

    public function loginauth(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (! empty(trim($username)) && ! empty(trim($password))) {
            $user = DB::table('master_masyarakats')
                ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
                ->where('nik', $username)->first();

            if ($user && $password == $user->password) {
                // Jika username dan password benar, maka redirect ke halaman dashboard
                return redirect('dashboard');
            } else {
                // Jika username dan password salah, maka redirect ke halaman login dengan pesan error
                echo "<script>alert('Username atau Password Salah');window.location='login';</script>";
                // return redirect('login')->with('error', 'Username atau password salah');
            }
        }
    }

    // Controller Master Masyarakat
    public function master_kk_mas(Request $request, $id)
    {
        $data = DB::table('master_masyarakats')
            ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
            ->where('master_kks.id', '=', $id)
            ->get();

        return view('master_kk_mas', ['nomor_kk' => $id], compact('data'));
    }

    public function simpanmasteruser(Request $request)
    {
        $this->validate($request, [
        ]);
        $request->validate([
            'nik' => 'required|max:16|min:16',
            'nama_lengkap' => 'required',
            'kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'gol_darah' => 'required',
            'status_perkawinan' => 'required',
            'status_keluarga' => 'required',
            'kewarganegaraan' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
        ], [
            'nik.required' => 'NIK Tidak Boleh Kosong',
            'nik.max' => 'NIK Maksimal 16 Angka',
            'nik.min' => 'NIK Minimal 16 Angka',
            'nama_lengkap.required' => 'Nama Lengkap Tidak Boleh Kosong',
            'kelamin.required' => 'Jenis Kelamin Tidak Boleh Kosong',
            'tempat_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong',
            'tgl_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong',
            'agama.required' => 'Agama Tidak Boleh Kosong',
            'pendidikan.required' => 'Pendidikan Tidak Boleh Kosong',
            'pekerjaan.required' => 'Pekerjaan Tidak Boleh Kosong',
            'gol_darah.required' => 'Golongan Darah Tidak Boleh Kosong',
            'status_perkawinan.required' => 'Status Perkawinan Tidak Boleh Kosong',
            'status_keluarga.required' => 'Status Keluarga Tidak Boleh Kosong',
            'kewarganegaraan.required' => 'Kewarganegaraan Tidak Boleh Kosong',
            'nama_ayah.required' => 'Nama Ayah Tidak Boleh Kosong',
            'nama_ibu.required' => 'Nama Ibu Tidak Boleh Kosong',
        ]);
        try {
            $data = new master_masyarakat();
            $uuid = Str::uuid()->toString();
            $data->id_masyarakat = $uuid;
            $data->id = $request->nokk;
            $data->nik = $request->nik;
            $data->nama_lengkap = $request->nama_lengkap;
            $data->jenis_kelamin = $request->kelamin;
            $data->tempat_lahir = $request->tempat_lahir;
            $data->tgl_lahir = $request->tgl_lahir;
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

            return Redirect('simpanakuns/'.$data->id_masyarakat);
        } catch (\Throwable $th) {
            throw $th;
        }

        try {
            $data = DB::table('master_masyarakats')
                ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
                ->orderBy('created_at', 'desc')
                ->limit(1)
                ->select('master_kks.id')
                ->first();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function simpanmasteruserakun(Request $request, $id)
    {
        try {
            $data = new master_akun();
            $uuid = Str::uuid()->toString();
            $data->id = $uuid;
            $data->no_hp = 62;
            $passwordhash = 'KepuharjoBermantra';
            $data->password = Hash::make($passwordhash);
            $data->role = 'masyarakat';
            $data->id_masyarakat = $id;
            $data->save();

        } catch (\Throwable $th) {
            throw $th;
        }

        try {
            $data = DB::table('master_masyarakats')
                ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
                ->where('master_masyarakats.id_masyarakat', '=', $id)
                ->first();

            return Redirect('masterkkmas/'.$data->id);
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function updatemasteruser(Request $request, $id)
    {
        $this->validate($request, [
        ]);
        $request->validate([
            'nik' => 'required|max:16|min:16',
            'nama_lengkap' => 'required',
            'kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'gol_darah' => 'required',
            'status_perkawinan' => 'required',
            'status_keluarga' => 'required',
            'kewarganegaraan' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
        ], [
            'nik.required' => 'NIK Tidak Boleh Kosong',
            'nik.max' => 'NIK Maksimal 16 Angka',
            'nik.min' => 'NIK Minimal 16 Angka',
            'nama_lengkap.required' => 'Nama Lengkap Tidak Boleh Kosong',
            'kelamin.required' => 'Jenis Kelamin Tidak Boleh Kosong',
            'tempat_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong',
            'tgl_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong',
            'agama.required' => 'Agama Tidak Boleh Kosong',
            'pendidikan.required' => 'Pendidikan Tidak Boleh Kosong',
            'pekerjaan.required' => 'Pekerjaan Tidak Boleh Kosong',
            'gol_darah.required' => 'Golongan Darah Tidak Boleh Kosong',
            'status_perkawinan.required' => 'Status Perkawinan Tidak Boleh Kosong',
            'status_keluarga.required' => 'Status Keluarga Tidak Boleh Kosong',
            'kewarganegaraan.required' => 'Kewarganegaraan Tidak Boleh Kosong',
            'nama_ayah.required' => 'Nama Ayah Tidak Boleh Kosong',
            'nama_ibu.required' => 'Nama Ibu Tidak Boleh Kosong',
        ]);
        try {
            $data = DB::table('master_masyarakats')->where('nik', $id)->update([
                // $data->nik = $request->nik,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'agama' => $request->agama,
                'pendidikan' => $request->pendidikan,
                'pekerjaan' => $request->pekerjaan,
                'golongan_darah' => $request->gol_darah,
                'status_perkawinan' => $request->status_perkawinan,
                'tgl_perkawinan' => $request->tgl_perkawinan,
                'status_keluarga' => $request->status_keluarga,
                'kewarganegaraan' => $request->kewarganegaraan,
                'no_paspor' => $request->no_paspor,
                'no_kitap' => $request->no_kitap,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }

        try {
            $data = DB::table('master_masyarakats')
                ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
                ->where('nik', '=', $request->nik)
                ->select('master_kks.id')
                ->first();

            return Redirect('masterkkmas/'.$data->id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function hapusmasteruser(Request $request, $id)
    {
        try {
            $data = master_masyarakat::where('nik', $id);
            $data->delete();

            return Redirect('masterkkmas/'.$request->nokk);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function ajax(Request $request)
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
            return view('ajaxpage')->with([
                'data' => $results,
            ]);
        }
    }

    public function read()
    {
        return 'Silahkan Melakukan Pencarian Data';
    }
    // Batas Controller Master Masyarakat

    // Controller Master RW
    public function simpanmasterrtrw(Request $request)
    {
        $this->validate($request, [
            // 'no_kk' => 'unique:master_kks'
        ]);
        $request->validate([
            'no_hp' => 'required|min:10|max:13'
        ],[
            'no_hp.required' => 'Nomor Telepon Tidak Boleh Kosong',
            'no_hp.min' => 'Nomor Telepon Minimal 10 Angka',
            'no_hp.max' => 'Nomor Telepon Maksimal 13 Angka'

        ]);
        $data = new master_akun();
        $uuid = Str::uuid()->toString();
        $data->id = $uuid;
        $data->no_hp = $request->no_hp;
        $passwordhash = $request->password;
        $data->password = Hash::make($passwordhash);
        $data->role = 'RW';
        $data->id_masyarakat = $request->id_masyarakat;
        $data->save();

        return Redirect('masterrtrw');
    }

    public function updatemasterrtrw(Request $request, $id)
    {
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

        public function hapusmasterrtrw(Request $request, $id)
        {
            $data = master_rtrw::where('nik', $id);
            $data->delete();

            return Redirect('masterrtrw');
        }

        public function master_rt()
        {
            $datartrw = DB::table('master_masyarakats')
                ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
                ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
                ->where('role', '=', 'RT')
                ->get();

            return view('master_rt', compact('datartrw'));
        }

        public function master_rtrw()
        {
            // $data = master_rtrw::all()
            // ->groupBy('master_kks.rw');
            try {
                $datartrw = DB::table('master_kks')
                    ->join('master_masyarakats', 'master_kks.id', '=', 'master_masyarakats.id')
                    ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            // ->select(DB::raw('master_kks.rw, master_masyarakats.nik'))
            // ->select(DB::raw('master_kks.rw, master_masyarakats.nik, count(master_akuns.role = RT)'))
                    ->where('master_akuns.role', '=', 'RW')
            // ->groupBy('master_kks.rw')
            // ->orderBy('master_kks.rw', 'ASC')
            // ->select(DB::raw('count(master_masyarakats.nik)'))
                    ->get();
                // dd($datartrw);
                return view('master_rtrw', compact('datartrw'));

            } catch (\Throwable $th) {
                //throw $th;
            }

                // $datartrw = master_rtrw::all()
                // // ->count('rt')
                // ->groupBy('rw');
                // // ->get();
                // // return view('master_rtrw', compact('datartrw'));

                // // // ->get();
                // dd($datartrw);
        }

        //Controller Master RT

        public function simpanmasterrt(Request $request)
        {
            $this->validate($request, [
                // 'no_kk' => 'unique:master_kks'
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

            return Redirect('masterrt');
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

    public function dashboard()
    {
        return view('dashboard');
    }

    public function suratmasuk()
    {
        return view('surat_masuk');
    }

    public function suratditolak()
    {
        return view('surat_ditolak');
    }

    public function suratselesai()
    {
        return view('surat_selesai');
    }

    public function masteruser()
    {
        $data = DB::table('master_masyarakats')
            ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
            ->get();

        return view('master_user', compact('data'));
    }

    public function tentang()
    {
        return view('tentang');
    }
}