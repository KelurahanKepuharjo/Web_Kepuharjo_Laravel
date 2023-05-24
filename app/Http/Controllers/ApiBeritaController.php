<?php

namespace App\Http\Controllers;

use App\Models\MobileBeritaModel;

class ApiBeritaController extends Controller
{
    public function berita()
    {
        $masterBerita = MobileBeritaModel::orderByDesc('id')->get();

        return response()->json([
            'message' => 'success',
            'data' => $masterBerita,
        ]);
    }
}
