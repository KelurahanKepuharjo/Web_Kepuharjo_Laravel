<?php

namespace App\Http\Controllers;

use App\Models\surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SuratRequest;

class SuratController extends Controller
{
    public function master_surat()
    {
        $data = surat::all();
        return view('master_surat', compact('data'));
    }

    public function simpan_surat(SuratRequest $suratrequest)
    {
        $validated = $suratrequest->validated();
        $surat = surat::create($validated);
        return Redirect('mastersurat')->with('success', '');
    }

    public function hapusmastersurat(Request $request, $id)
    {
        $data = surat::where('id_surat', $id);
        $data->delete();
        return Redirect('mastersurat')->with('successhapus', '');
    }

    public function updatesurat(Request $request, $id)
    {
        $data = DB::table('master_surats')->where('id_surat', $id)->update([
            'nama_surat' => $request->nama_surat,
        ]);
        return Redirect('mastersurat')->with('successedit', '');
    }
}
