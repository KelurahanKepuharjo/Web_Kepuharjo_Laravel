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
        $imageName = time().'.'.$beritaRequest->image->getClientOriginalExtension();
        $beritaRequest->image->move(public_path('images'), $imageName);
        $validated['image'] = $imageName;
        $validated = $beritaRequest->validated();
        $Berita = berita::create([
            'judul' => $validated['judul'],
            'sub_title' => $validated['sub_title'],
            'deskripsi' => $validated['deskripsi'],
            'image' => $imageName
        ]);

        return Redirect('berita')->with('success', '');
    }

    public function update(BeritaRequest $beritaRequest, $id)
    {
        $berita = Berita::where('id', $id)->first();
        $imageName = time().'.'.$beritaRequest->image->getClientOriginalExtension();
        $beritaRequest->image->move(public_path('images'), $imageName);
        $validated['image'] = $imageName;
        $validated = $beritaRequest->validated();
        $Berita->update([
            'judul' => $validated['judul'],
            'sub_title' => $validated['sub_title'],
            'deskripsi' => $validated['deskripsi'],
            'image' => $imageName
        ]);
        return back()->with('successedit', '');
    }

    public function delete(Request $request, $id)
    {
        $data = berita::where('id', $id);
        $data->delete();

        return Redirect('berita')->with('successhapus', '');
    }
}
