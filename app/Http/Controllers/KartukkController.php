<?php

namespace App\Http\Controllers;

use App\Http\Requests\KartukkeditRequest;
use App\Http\Requests\KartukkRequest;
use App\Models\MobileMasterKksModel;
use App\Models\MobileMasterMasyarakatModel;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KartukkController extends Controller
{
    public function index()
    {
        $data = MobileMasterMasyarakatModel::with('masyarakat')->get();

        return view('master_kk', compact('data'))->with('success','');
    }

    public function update(Request $request, KartukkeditRequest $kartukkeditRequest, $id)
    {
        $validated = $kartukkeditRequest->validated();
        $data = MobileMasterKksModel::where('no_kk', $id)->first();
        $data->update([
            'no_kk' => $validated['nokkedit'],
            'alamat' => $validated['alamatkkedit'],
            'rt' => $validated['rtedit'],
            'rw' => $validated['rwedit'],
            'kode_pos' => $validated['kdposedit'],
            'kelurahan' => $validated['keledit'],
            'kecamatan' => $validated['kecedit'],
            'kabupaten' => $validated['kabedit'],
            'provinsi' => $validated['provedit'],
            'kk_tgl' => $validated['tglkkedit'],
        ]);

        return Redirect('masterkk')->with('successedit', '');
    }

    //Untuk Hapus Master KK
    public function delete(Request $request, $id)
    {
        $data = MobileMasterKksModel::where('no_kk', $id);
        $data->delete();

        return Redirect('masterkk')->with('successhapus', '');
    }

      public function simpanmasterkk(Request $request, KartukkRequest $kkrequest)
      {


            $validated = $kkrequest->validated();
            $check = MobileMasterKksModel::all();
            foreach ($check as  $value) {
                if ($value->no_kk == $validated['no_kk']) {
                    return redirect()->back()->with('exist','');
                }
            }

            $data = MobileMasterKksModel::create($validated);
            return redirect('simpankepala/'.$request->no_kk.'/'.$request->kepala_keluarga.'/'.$request->nik);
      }

    public function simpankepalakeluarga(Request $request, $id, $other_id, $nik)
    {
        try {
            $datakepala = MobileMasterKksModel::where('no_kk', '=', $id)
                ->first();
            $data = new MobileMasterMasyarakatModel();
            $uuid = Str::uuid()->toString();
            $data->id_masyarakat = $uuid;
            $data->id = $datakepala->id;
            $data->nik = $nik;
            $data->nama_lengkap = $other_id;
            $data->status_keluarga = 'Kepala Keluarga';
            $data->save();

            return Redirect('masterkk')->with('success', 'Berhasil Disimpan');
        } catch (\Throwable $th) {

        }

        try {
            $data = MobileMasterMasyarakatModel::with('masyarakat')
                ->orderBy('created_at', 'desc')
                ->limit(1)
                ->select('master_kks.id')
                ->first();
        } catch (\Throwable $th) {
        }

    }
}
