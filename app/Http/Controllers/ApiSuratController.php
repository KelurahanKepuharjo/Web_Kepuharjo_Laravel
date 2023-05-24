<?php

namespace App\Http\Controllers;

use App\Models\MobileMasterSuratModel;

class ApiSuratController extends Controller
{
    public function surat()
    {
        $masterSurat = MobileMasterSuratModel::orderByDesc('id_surat')->get();

        return response()->json([
            'message' => 'success',
            'data' => $masterSurat,
        ]);
    }
}
