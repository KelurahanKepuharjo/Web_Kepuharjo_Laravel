<?php

namespace App\Http\Controllers\Api;

use App\Models\MobileMasterSuratModel;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function surat()
    {
        try {
            $masterSurat = MobileMasterSuratModel::all();
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
