<?php

namespace App\Http\Controllers;

use App\Models\MobileMasterAkunModel;
use App\Models\MobileMasterKksModel;
use App\Models\MobileMasterMasyarakatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string',
            'nik' => 'required|string|min:16',
            'password' => 'required|min:8',
        ]);

        $dataMasyarakat = MobileMasterMasyarakatModel::where('nik', $request->nik)->first();
        if (!$dataMasyarakat) {
            return response()->json([
                'message' => 'Nik anda belum terdaftar',
            ]);
        }
        if (MobileMasterAkunModel::where('id_masyarakat', $dataMasyarakat->id_masyarakat)->exists()) {
            return response()->json([
                'message' => 'Akun sudah terdaftar',
            ]);
        }

        $data = MobileMasterAkunModel::create([
            'id_masyarakat' => $dataMasyarakat->id_masyarakat,
            'role' => '4',
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        $response = [
            'message' => 'Berhasil Register',
            'user' => $data,
        ];
        return response()->json($response);
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|min:16',
            'password' => 'required|string|min:8',
        ]);

        $dataMasyarakat = MobileMasterMasyarakatModel::where('nik', $request->nik)->first();
        if (!$dataMasyarakat) {
            return response()->json([
                'message' => 'Nik Anda Belum Terdaftar',
            ], 400);
        }

        $akun = MobileMasterAkunModel::where('id_masyarakat', $dataMasyarakat->id_masyarakat)->first();
        if (!Hash::check($request->password, $akun->password)) {
            return response()->json([
                'message' => 'Password Anda Salah',
            ], 400);
        }

        if ($akun->role == 1) {
            return response()->json([
                'message' => 'Anda tidak memiliki akses untuk login',
            ], 400);
        }

        $token = $akun->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Berhasil login',
            'user' => $dataMasyarakat,
            'token' => $token,
            'role' => $akun->role,
        ]);
    }

    public function storeFCMToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string'
        ]);

        $user = auth()->user();
        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response()->json([
            'message' => 'Token perangkat berhasil disimpan',
        ]);
    }


    public function me(Request $request)
    {
        $user = $request->user();

        $response = [
            'message' => 'success',
            'data' => $user->load(['masyarakat', 'masyarakat.kks']),
        ];

        return response()->json($response, 200);
    }

    public function logout()
    {
        $logout = request()->user()->currentAccessToken()->delete();
        $response = [
            'message' => 'success',
        ];

        return response()->json($response, 200);
    }

    public function keluarga(Request $request)
    {
        $user = $request->user();
        $id_masyarakat = $user->id_masyarakat;

        // Ambil nomor kartu keluarga dari user
        $no_kk = MobileMasterKksModel::whereHas('masyarakat', function ($query) use ($id_masyarakat) {
            $query->where('id_masyarakat', $id_masyarakat);
        })->value('no_kk');

        $keluarga = MobileMasterKksModel::with('masyarakat')->where('no_kk', $no_kk)->first();

        $response = [
            'message' => 'success',
            'data' => $keluarga,
        ];

        return response()->json($response);
    }

    public function editnohp(Request $request)
    {
        $user = $request->user();
        $no_hp = $user->no_hp;

        $validator = Validator::make($request->all(), [
            'no_hp' => [
                'required',
                'min:10',
                'unique:master_akuns,no_hp,' . $user->id,
                function ($attribute, $value, $fail) use ($no_hp) {
                    if ($value === $no_hp) {
                        $fail('Nomor HP baru harus berbeda dengan nomor HP lama');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
            ]);
        }

        $user->update([
            'no_hp' => $request->no_hp,
        ]);

        return response()->json([
            'message' => 'Nomor HP berhasil diperbarui',
        ]);
    }
}
