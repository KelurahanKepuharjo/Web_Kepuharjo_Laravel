<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeritaRequest;
use App\Models\berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $data = berita::all();

        return view('berita', compact('data'));
    }

    public function store(BeritaRequest $beritaRequest)
    {
        $validated = $beritaRequest->validated();
        $Berita = berita::create($validated);

        return Redirect('berita')->with('success', '');
    }

    public function update(BeritaRequest $request, $id, berita $berita)
    {
        $berita = Berita::find($id);
        $validated = $request->validated();
        $berita->update($validated);

        return back()->with('successedit', '');
    }

    public function delete(Request $request, $id)
    {
        $data = berita::where('id', $id);
        $data->delete();

        return Redirect('berita')->with('successhapus', '');
    }
}
