<?php

namespace App\Http\Controllers;

class WebBeritaController extends Controller
{
    public function berita()
    {
        try {
            $masterBerita = master_berita::all();

            return response()->json([
                'message' => 'success',
                'data' => $masterBerita,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => [],
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
