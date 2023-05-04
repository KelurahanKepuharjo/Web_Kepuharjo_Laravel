<?php

namespace App\Http\Controllers;

use App\Models\master_akun;
use App\Models\master_kks;
use App\Models\master_masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KartukkController extends Controller
{
    public function master_kk()
    {
        $data = DB::table('master_kks')
            ->join('master_masyarakats', 'master_masyarakats.id', '=', 'master_kks.id')
            ->where('master_masyarakats.status_keluarga', '=', 'Kepala Keluarga')
            ->orderBy('master_kks.rw', 'asc')
            ->orderBy('master_kks.rt', 'asc')
            ->get();

        return view('master_kk', compact('data'));
    }

    public function simpanmasteruserakunkk(Request $request, $id)
    {
        try {
            $data = new master_akun();
            $uuid = Str::uuid()->toString();
            $data->id = $uuid;
            $data->no_hp = 62;
            $data->password = 'KepuharjoBermantra';
            $data->role = 'masyarakat';
            $data->id_masyarakat = $id;
            $data->save();

            return Redirect('masterkk')->with('success', '');

        } catch (\Throwable $th) {
        }
    }

    public function simpankepalakeluarga(Request $request, $id, $other_id, $nik)
    {
        try {
            $datakepala = DB::table('master_kks')
                ->select('master_kks.id')
                ->where('master_kks.no_kk', '=', $id)
                ->first();
            $data = new master_masyarakat();
            $uuid = Str::uuid()->toString();
            $data->id_masyarakat = $uuid;
            $data->id = $datakepala->id;
            $data->nik = $nik;
            $data->nama_lengkap = $other_id;
            $data->status_keluarga = 'Kepala Keluarga';
            $data->save();

            return Redirect('simpanakunskk/'.$data->id_masyarakat);
        } catch (\Throwable $th) {
        }

        try {
            $data = DB::table('master_masyarakats')
                ->join('master_kks', 'master_kks.id', '=', 'master_masyarakats.id')
                ->orderBy('created_at', 'desc')
                ->limit(1)
                ->select('master_kks.id')
                ->first();
        } catch (\Throwable $th) {
        }

    }

      // Untuk Simpan Master KK
      public function simpanmasterkk(Request $request)
      {
          $validator = Validator::make($request->all(), [
              'nokk' => 'required|max:16|min:16',
              'nik' => 'required|max:16|min:16',
              'kepala_keluarga' => 'required',
              'alamatkk' => 'required',
              'rt' => 'required',
              'rw' => 'required',
              'tglkk' => 'required',
          ], [
              'nokk.required' => 'Nomor kartu keluarga tidak boleh kosong',
              'nokk.min' => 'Nomor kartu keluarga miniman 16 angka',
              'nokk.max' => 'Nomor kartu keluarga maximal 16 angka',
              'nik.required' => 'Nik tidak boleh kosong',
              'nik.min' => 'Nik minimal 16 angka',
              'nik.max' => 'Nik maximal 16 angka',
              'kepala_keluarga.required' => 'Nama Kepala Keluarga tidak boleh kosong',
              'alamatkk.required' => 'Alamat tidak boleh kosong',
              'rt.required' => 'Rt tidak boleh kosong',
              'rw.required' => 'Rw tidak boleh kosong',
              'tglkk.required' => 'Tanggal KK tidak boleh kosong',
          ]);

          if ($validator->fails()) {
              // return response()->json(['error'=>$validator->errors()]);
              return redirect()->back()->withErrors($validator)->withInput();
          }

          $data = new master_kks();
          $data->no_kk = $request->nokk;
          $data->alamat = $request->alamatkk;
          $data->rt = $request->rt;
          $data->rw = $request->rw;
          $data->kode_pos = $request->kdpos;
          $data->kelurahan = $request->kel;
          $data->kecamatan = $request->kec;
          $data->kabupaten = $request->kab;
          $data->provinsi = $request->prov;
          $data->kk_tgl = $request->tglkk;
          $data->save();

          return redirect('simpankepala/'.$request->nokk.'/'.$request->kepala_keluarga.'/'.$request->nik);
      }

    //Untuk Update Master KK
      public function update(Request $request, $id)
      {

          $validator = Validator::make($request->all(), [
              'nokkedit' => 'required|max:16|min:16',
              'nikedit' => 'required|max:16|min:16',
              'kepala_keluargaedit' => 'required',
              'alamatkkedit' => 'required',
              'rtedit' => 'required',
              'rwedit' => 'required',
          ], [
              'nokkedit.required' => 'Nomor kartu keluarga tidak boleh kosong',
              'nokkedit.min' => 'Nomor kartu keluarga miniman 16 angka',
              'nokkedit.max' => 'Nomor kartu keluarga maximal 16 angka',
              'nikedit.required' => 'Nik tidak boleh kosong',
              'nikedit.min' => 'Nik minimal 16 angka',
              'nikedit.max' => 'Nik maximal 16 angka',
              'kepala_keluargaedit.required' => 'Nama Kepala Keluarga tidak boleh kosong',
              'alamatedit.required' => 'Alamat tidak boleh kosong',
              'rtedit.required' => 'Rt tidak boleh kosong',
              'rwedit.required' => 'Rw tidak boleh kosong',
          ]);

          if ($validator->fails()) {
              return redirect()->back()->withErrors($validator)->withInput();
          }

          try {
              $data = DB::table('master_kks')->where('no_kk', $id)->update([
                  'no_kk' => $request->nokkedit,
                  'alamat' => $request->alamatkkedit,
                  'rt' => $request->rtedit,
                  'rw' => $request->rwedit,
                  'kode_pos' => $request->kdposedit,
                  'kelurahan' => $request->keledit,
                  'kecamatan' => $request->kecedit,
                  'kabupaten' => $request->kabedit,
                  'provinsi' => $request->provedit,
                  'kk_tgl' => $request->tglkkedit,
              ]);

              return Redirect('masterkk')->with('successedit', '');

          } catch (\Throwable $th) {
              throw $th;
          }

      }

      //Untuk Hapus Master KK
      public function hapus(Request $request, $id)
      {

          $data = DB::table('master_kks')
              ->join('master_masyarakats', 'master_kks.id', '=', 'master_masyarakats.id')
              ->join('master_akuns', 'master_masyarakats.id_masyarakat', '=', 'master_akuns.id_masyarakat')
              ->where('master_kks.no_kk', $id)
              ->first();
      }
}
