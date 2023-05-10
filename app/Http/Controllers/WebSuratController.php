<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratRequest;
use App\Models\surat;
use Illuminate\Http\Request;

class WebSuratController extends Controller
{
    public function surat(){
        try {
                $masterSurat = master_surat::all();
                return response()->json([
                    'message' => 'success',
                    'data' => $masterSurat
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
