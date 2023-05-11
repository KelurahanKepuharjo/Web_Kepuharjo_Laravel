<?php

namespace App\Http\Controllers;

use App\Models\master_akun;
use App\Models\master_rtrw;
use App\Models\RwaksesModal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RwController extends Controller
{
    public function Rw()
    {
        $rw = new RwaksesModal();
        $data = $rw->Rw()
            ->where('nik', '350810201002000')
            ->first();
        if ($data) {
            dd('Data dengan nik  sudah ada');
        } else {
            dd('Data dengan nik  belum ada');
        }
    }

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

    public function simpanmasterrw(Request $request, $id)
    {
        $datacheck = DB::table('master_kks')
            ->join('master_masyarakats', 'master_kks.id', '=', 'master_masyarakats.id')
            ->join('master_akuns', 'master_akuns.id_masyarakat', 'master_masyarakats.id_masyarakat')
            ->where('master_kks.rw', $request->rw)
            ->where('master_akuns.role', 'RW')
            ->first();
        if ($datacheck !== null) {
            return Redirect('masterrw')->with('errorissetrw', '');
        } else {
            // dd('data bisa ditamabhkan');
            $rw = new RwaksesModal();
            $data = $rw->Rw()
                ->where('nik', $id)
                ->first();
            if ($data) {
                if ($data->role == 'RT') {
                    return Redirect('masterrw')->with('errorrt', '');
                } elseif ($data->role == 'RW') {
                    return Redirect('masterrw')->with('errorrw', '');
                } elseif ($data->role == '4') {
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

                    return Redirect('masterrw')->with('success', '');
                }
            } else {
                $data = DB::table('master_masyarakats')
                    ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
                    ->where('master_masyarakats.nik', '=', $id)
                    ->first();
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

                return Redirect('masterrw')->with('success', '');
            }
        }
    }

    public function updatemasterrw(Request $request, $id)
    {
        $passwordhash = $request->password;
        $pass = Hash::make($passwordhash);
        $data = DB::table('master_kks')
            ->join('master_masyarakats', 'master_masyarakats.id', '=', 'master_kks.id')
            ->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->where('master_masyarakats.nik', $request->nik)
            ->where('master_akuns.role', 'RW')
            ->update([
                'master_akuns.no_hp' => $request->no_hp,
                'master_akuns.password' => $pass,
            ]);

        return Redirect('masterrw');
    }
}
