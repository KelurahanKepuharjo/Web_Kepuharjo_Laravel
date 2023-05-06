<?php

namespace App\Http\Controllers;

use App\Models\master_akun;
use App\Models\master_rtrw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RwController extends Controller
{
    public function master_rw()
    {
            $datartrw = DB::table('master_kks')
                ->join('master_masyarakats', 'master_kks.id', '=', 'master_masyarakats.id')
                ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
                ->where('master_akuns.role', '=', 'RW')
                ->get();

            return view('master_rw', compact('datartrw'));
    }

    public function hapusmasterrw(Request $request, $id)
    {
        $data = master_rtrw::where('nik', $id);
        $data->delete();

        return Redirect('masterrw');
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

    public function simpanmasterrw(Request $request)
    {
        $this->validate($request, [
            // 'no_kk' => 'unique:master_kks'
        ]);
        $request->validate([
            'no_hp' => 'required|min:10|max:13',
        ], [
            'no_hp.required' => 'Nomor Telepon Tidak Boleh Kosong',
            'no_hp.min' => 'Nomor Telepon Minimal 10 Angka',
            'no_hp.max' => 'Nomor Telepon Maksimal 13 Angka',

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

        return Redirect('masterrw');
    }

    public function updatemasterrw(Request $request, $id)
    {
        $data = master_rtrw::where('nik', $id)->first();
        $data->nik = $request->nik;
        $data->nama_lengkap = $request->nama_lengkap;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->rt = $request->rt;
        $data->rw = $request->rw;
        $data->save();

        return Redirect('masterrw');
    }
}
