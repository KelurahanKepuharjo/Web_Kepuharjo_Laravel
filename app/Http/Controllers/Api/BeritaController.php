<?php

namespace App\Http\Controllers;

use App\Models\MobileBeritaModel;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function berita()
    {
        try {
            $masterBerita = MobileBeritaModel::all();
            return response()->json([
                'message' => 'success',
                'data' => $masterBerita
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => [],
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
