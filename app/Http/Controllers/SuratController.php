<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratRequest;
use App\Models\surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $data = surat::all();

        return view('master_surat', compact('data'));
    }

    public function store(SuratRequest $suratrequest)
    {
        $validated = $suratrequest->validated();
        $surat = surat::create($validated);

        return Redirect('mastersurat')->with('success', '');
    }

    public function delete(Request $request, $id)
    {
        $data = surat::where('id_surat', $id);
        $data->delete();

        return Redirect('mastersurat')->with('successhapus', '');
    }

    public function update(SuratRequest $suratrequest, $id)
    {
        $data = surat::where('id_surat', $id)->first();
        $validated = $suratrequest->validated();
        $data->update($validated);

        return Redirect('mastersurat')->with('successedit', '');
    }
}
