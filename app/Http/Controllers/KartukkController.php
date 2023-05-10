<?php

namespace App\Http\Controllers;

use App\Http\Requests\KartukkeditRequest;
use App\Http\Requests\KartukkRequest;
use App\Models\master_kks;
use App\Models\master_masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KartukkController extends Controller
{
    public function index()
    {
        $data = DB::table('master_kks')
            ->join('master_masyarakats', 'master_masyarakats.id', '=', 'master_kks.id')
            ->where('master_masyarakats.status_keluarga', '=', 'Kepala Keluarga')
            ->orderBy('master_kks.rw', 'asc')
            ->orderBy('master_kks.rt', 'asc')
            ->get();

        return view('master_kk', compact('data'));
    }

    public function update(Request $request, KartukkeditRequest $kartukkeditRequest, $id)
    {
        $validator = $kartukkeditRequest->validated();
        $data = master_kks::where('no_kk', $id)->first();
        $data->update([
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
    }

    //Untuk Hapus Master KK
    public function delete(Request $request, $id)
    {
        $data = master_kks::where('no_kk', $id);
        $data->delete();

        return Redirect('masterkk')->with('successhapus', '');
    }

      public function simpanmasterkk(Request $request, KartukkRequest $kkrequest)
      {
          $validated = $kkrequest->validated();
          $data = master_kks::create($validated);

          return redirect('simpankepala/'.$request->no_kk.'/'.$request->kepala_keluarga.'/'.$request->nik);
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

            return Redirect('masterkk')->with('success', '');
            // return Redirect('simpanakunskk/'.$data->id_masyarakat);
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
}
