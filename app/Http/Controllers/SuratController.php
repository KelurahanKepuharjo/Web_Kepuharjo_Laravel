<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratRequest;
use App\Models\MobileMasterSuratModel;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $data = MobileMasterSuratModel::all();

        return view('master_surat', compact('data'));
    }

    public function store(SuratRequest $suratrequest)
    {
        $imageName = time().'.'.$suratrequest->image->getClientOriginalExtension();
        $suratrequest->image->move(public_path('images'), $imageName);
        $validated['image'] = $imageName;
        $validated = $suratrequest->validated();
        $surat = MobileMasterSuratModel::create([
            'id_surat' => $validated['id_surat'],
            'nama_surat' => $validated['nama_surat'],
            'image' => $imageName,
        ]);

        return Redirect('mastersurat')->with('success', '');
    }

    public function delete(Request $request, $id)
    {
        $data = MobileMasterSuratModel::where('id_surat', $id);
        $data->delete();

        return Redirect('mastersurat')->with('successhapus', '');
    }

    public function update(SuratRequest $suratrequest, $id)
    {
        $data = MobileMasterSuratModel::where('id_surat', $id)->first();
        $imageName = time().'.'.$suratrequest->image->getClientOriginalExtension();
        $suratrequest->image->move(public_path('images'), $imageName);
        $validated['image'] = $imageName;
        $validated = $suratrequest->validated();
        $data->update([
            'id_surat' => $validated['id_surat'],
            'nama_surat' => $validated['nama_surat'],
            'image' => $imageName,
        ]);

        return Redirect('mastersurat')->with('successedit', '');
    }
}
