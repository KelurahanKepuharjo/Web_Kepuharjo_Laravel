<?php

namespace App\Http\Controllers;

use App\Models\berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function berita()
    {
        $data = berita::all();

        return view('berita', compact('data'));
    }

    // Untuk Simpan Berita
    public function simpanmasterberita(Request $request)
    {
        $this->validate($request, [
            // 'no_kk' => 'unique:master_kks'
        ]);
        try {
            $data = new berita();
            $data->judul = $request->judul;
            $data->sub_title = $request->subtitle;
            $data->deskripsi = $request->deskripsi;
            $data->save();

            return Redirect('berita')->with('success', '');
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    // Untuk Update Berita
    public function updateberita(Request $request, $id)
    {
        $data = berita::where('id', $id)->first();
        $data->judul = $request->judul;
        $data->sub_title = $request->subtitle;
        $data->deskripsi = $request->deskripsi;
        $data->save();

        return Redirect('berita')->with('successedit', '');
    }

    // Untuk Hapus Berita
    public function hapusberita(Request $request, $id)
    {
        $data = berita::where('id', $id);
        $data->delete();

        return Redirect('berita')->with('successhapus', '');
    }
}
