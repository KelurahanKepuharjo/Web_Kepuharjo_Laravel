<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeritaRequest;
use App\Models\berita;
use Illuminate\Http\Request;

class WebBeritaController extends Controller
{
    public function berita(){
        try {
            $masterBerita = master_berita::all();
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
