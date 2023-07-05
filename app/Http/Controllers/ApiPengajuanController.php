<?php

namespace App\Http\Controllers;

use App\Models\MobileMasterAkunModel;
use App\Models\MobileMasterKksModel;
use App\Models\MobileMasterMasyarakatModel;
use App\Models\MobilePengajuanSuratModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiPengajuanController extends Controller
{
    public function pengajuan(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'keterangan' => 'required',
            'id_surat' => 'required',
            'image_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image_bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $masyarakat = MobileMasterMasyarakatModel::where('nik', $request->nik)->first();

        $akun = MobileMasterAkunModel::where('id_masyarakat', $masyarakat->id_masyarakat)->first();

        if ($akun->role != 4) {
            return response()->json([
                'message' => 'Anda tidak memiliki akses untuk mengajukan surat',
            ]);
        }

        $existingSurat = MobilePengajuanSuratModel::where('id_surat', $request->id_surat)
            ->where('id_masyarakat', $masyarakat->id_masyarakat)
            ->first();
        $imagekk = $request->file('image_kk');
        $imagebukti = $request->file('image_bukti');

        $imagenamekk = "img_" . Str::random(10) . time() . '.' . $imagekk->getClientOriginalExtension();
        $imagenamebukti = "img_" . Str::random(10) . time() . '.' . $imagebukti->getClientOriginalExtension();

        $imagekk->move(public_path('images/'), $imagenamekk);
        $imagebukti->move(public_path('images/'), $imagenamebukti);
        if (!$existingSurat) {
            $data = MobilePengajuanSuratModel::create([
                'status' => 'Diajukan',
                'keterangan' => $request->keterangan,
                'id_surat' => $request->id_surat,
                'info' => 'active',
                'image_kk' => $imagenamekk,
                'image_bukti' => $imagenamebukti,
                'id_masyarakat' => $masyarakat->id_masyarakat,
            ]);

            return response()->json([
                'message' => 'Berhasil mengajukan surat',
                'data' => $data
            ], 200);
        } else {
            $cek = MobilePengajuanSuratModel::where('id_surat', $request->id_surat)
                ->where('id_masyarakat', $masyarakat->id_masyarakat)
                ->where('info', 'active')
                ->exists();

            if ($cek) {
                return response()->json([
                    'message' => 'Surat sebelumnya belum selesai',
                ], 404);
            } else {
                $data = MobilePengajuanSuratModel::create([
                    'keterangan' => $request->keterangan,
                    'status' => 'Diajukan',
                    'info' => 'active',
                    'id_surat' => $request->id_surat,
                    'image_kk' => $imagenamekk,
                    'image_bukti' => $imagenamebukti,
                    'id_masyarakat' => $masyarakat->id_masyarakat,
                ]);

                return response()->json([
                    'message' => 'Berhasil mengajukan surat',
                    'data' => $data
                ], 200);
            }
        }
    }

    public function status_proses(Request $request)
    {
        $user = $request->user();
        $id_masyarakat = $user->id_masyarakat;

        $no_kk = MobileMasterKksModel::whereHas('masyarakat', function ($query) use ($id_masyarakat) {
            $query->where('id_masyarakat', $id_masyarakat);
        })->value('no_kk');

        $pengajuan_surats = MobilePengajuanSuratModel::with('surat', 'masyarakat.kks')
        ->where(function ($query) use ($id_masyarakat, $no_kk) {
            $query->where('id_masyarakat', $id_masyarakat)
                ->orWhereHas('masyarakat.kks', function ($query) use ($no_kk) {
                    $query->where('no_kk', $no_kk);
                });
        })
            ->whereNotIn('status', ['Selesai', 'Diajukan', 'Dibatalkan', 'Ditolak RT'])
            ->get();

        return response()->json([
            'message' => 'success',
            'data' => $pengajuan_surats,
        ], 200);
    }


    public function status_surat(Request $request)
    {
        $user = $request->user();
        $id_masyarakat = $user->id_masyarakat;
        $status = $request->status;

        $no_kk = MobileMasterKksModel::whereHas('masyarakat', function ($query) use ($id_masyarakat) {
            $query->where('id_masyarakat', $id_masyarakat);
        })->value('no_kk');

        $pengajuan_surats = MobilePengajuanSuratModel::with('surat', 'masyarakat.kks')
            ->where(function ($query) use ($id_masyarakat, $no_kk) {
                $query->where('id_masyarakat', $id_masyarakat)
                    ->orWhereHas('masyarakat.kks', function ($query) use ($no_kk) {
                        $query->where('no_kk', $no_kk);
                    });
            })
            ->where('status', $status)
            ->get();

        return response()->json([
            'message' => 'success',
            'data' => $pengajuan_surats,
        ], 200);
    }

    public function pembatalan(Request $request, $id)
    {
        $userId = $request->user()->id_masyarakat;
        $pengajuanSurat = MobilePengajuanSuratModel::where('id', $id)
            ->where('id_masyarakat', $userId)
            ->where('status', 'Diajukan')
            ->firstOrFail();

        $pengajuanSurat->update(['status' => 'Dibatalkan', 'info' => 'non_active']);

        return response()->json([
            'message' => 'Surat berhasil dibatalkan',
        ], 200);
    }
}
