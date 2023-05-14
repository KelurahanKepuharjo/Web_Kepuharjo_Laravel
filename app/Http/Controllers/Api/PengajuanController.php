<?php

namespace App\Http\Controllers\Api;

use App\Models\MobileMasterKksModel;
use App\Models\MobileMasterMasyarakatModel;
use App\Models\MobilePengajuanSuratModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    public function pengajuan(Request $request)
    {
        $now = Carbon::now();
        $request->validate([
            'nik' => 'required',
            'keterangan' => 'required',
            'id_surat' => 'required',
        ]);
        $masyarakat = MobileMasterMasyarakatModel::where('nik', $request->nik)->first();

        if (!$masyarakat) {
            return response()->json([
                'message' => 'Nik tidak ditemukan',
            ], 400);
        }

        $existingSurat = MobilePengajuanSuratModel::where('id_surat', $request->id_surat)
            ->where('id_masyarakat', $masyarakat->id_masyarakat)
            ->first();

        if (!$existingSurat) {
            $data = MobilePengajuanSuratModel::create([
                'uuid' => Str::uuid(),
                'status' => 'Diajukan',
                'keterangan' => $request->keterangan,
                'id_surat' => $request->id_surat,
                'created_at' => $now,
                'id_masyarakat' => $masyarakat->id_masyarakat,
            ]);

            return response()->json([
                'message' => 'Berhasil mengajukan surat',
                'data' => $data
            ], 200);
        } else {
            $cek = MobilePengajuanSuratModel::where('id_surat', $request->id_surat)
                ->where('id_masyarakat', $masyarakat->id_masyarakat)
                ->whereIn('status', ['Selesai', 'Ditolak RT', 'Ditolak RW'], 'and', true)
                ->exists();

            if ($cek) {
                return response()->json([
                    'message' => 'Surat sebelumnya belum selesai',
                ], 400);
            } else {
                $data = MobilePengajuanSuratModel::create([
                    'uuid' => Str::uuid(),
                    'status' => $request->status,
                    'keterangan' => 'Diajukan',
                    'id_surat' => $request->id_surat,
                    'created_at' => $now,
                    'id_masyarakat' => $masyarakat->id_masyarakat,
                ]);

                return response()->json([
                    'message' => 'Berhasil mengajukan surat',
                    'data' => $data
                ], 200);
            }
        }
    }
    public function suratmasuk(Request $request)
    {

        $rt = $request->input('rt'); // rt yang dipilih atau ditentukan
        $status = $request->input('status');
        $suratMasuk = MobilePengajuanSuratModel::select('pengajuan_surats.*', 'master_surats.*', 'master_masyarakats.*')
            ->join('master_masyarakats', 'pengajuan_surats.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('master_surats', 'pengajuan_surats.id_surat', '=', 'master_surats.id_surat')
            ->where('pengajuan_surats.status', $status)
            ->whereHas('akun', function ($query) use ($rt) {
                $query->whereHas('kks', function ($query) use ($rt) {
                    $query->where('rt', $rt);
                });
            })
            ->with('surat')
            ->get();

        return response()->json([
            'message' => 'success',
            'data' => $suratMasuk
        ], 200);
    }

    public function rekap(Request $request)
    {
        $rt = $request->input('rt'); // rt yang dipilih atau ditentukan
        $suratMasuk = MobilePengajuanSuratModel::select('pengajuan_surats.*', 'master_akuns.id as id_akun', 'master_masyarakats.*')
            ->join('master_akuns', 'pengajuan_surats.id', '=', 'master_akuns.id')
            ->join('master_masyarakats', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->whereHas('akun.masyarakat', function ($query) use ($rt) {
                $query->whereHas('kks', function ($query) use ($rt) {
                    $query->where('rt', $rt);
                });
            })
            ->with('surat')
            ->get();

        return response()->json([
            'message' => 'success',
            'data' => $suratMasuk
        ], 200);
    }

    public function statussurat(Request $request)
    {
        $no_kk = $request->input('no_kk');
        $status = $request->input('status');
        $statussurat = MobilePengajuanSuratModel::select('pengajuan_surats.*', 'master_akuns.*', 'master_masyarakat.*')
            ->join('master_akuns', 'pengajuan_surats.id', '=', 'master_akuns.id')
            ->join('master_masyarakats', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakats')
            ->where('pengajuan_surats.status', $status)
            ->whereHas('akun.masyarakat', function ($query) use ($no_kk) {
                $query->where('no_kk', $no_kk);
            })
            ->with('surat')
            ->get();

        return response()->json([
            'message' => 'success',
            'data' => $statussurat
        ], 200);
    }

    public function statusproses(Request $request)
    {
        $user = $request->user();
        $id_masyarakat = $user->id_masyarakat;

        $no_kk = MobileMasterKksModel::whereHas('masyarakat', function ($query) use ($id_masyarakat) {
            $query->where('id_masyarakat', $id_masyarakat);
        })->value('no_kk');

        // menggunakan query builder
        $pengajuan_surats = DB::table('pengajuan_surats')
            ->join('master_surats', 'pengajuan_surats.id_surat', '=', 'master_surats.id_surat')
            ->join('master_masyarakats', 'pengajuan_surats.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('master_kks', 'master_masyarakats.id', '=', 'master_kks.id')
            ->where(function ($query) use ($id_masyarakat, $no_kk) {
                $query->where('pengajuan_surats.id_masyarakat', $id_masyarakat)
                    ->orWhere('master_kks.no_kk', '=', $no_kk);
            })
            ->whereNotIn('pengajuan_surats.status', ['Selesai', 'Diajukan', 'Dibatalkan', 'Ditolak RT', 'Ditolak RW'])
            ->select('pengajuan_surats.*', 'master_masyarakats.*', 'master_surats.*')
            ->get();

        return response()->json([
            'message' => 'success',
            'data' => $pengajuan_surats
        ], 200);
    }

    public function statusdiajukan(Request $request)
    {
        $user = $request->user();
        $id_masyarakat = $user->id_masyarakat;
        $status = $request->status;

        $no_kk = MobileMasterKksModel::whereHas('masyarakat', function ($query) use ($id_masyarakat) {
            $query->where('id_masyarakat', $id_masyarakat);
        })->value('no_kk');

        // menggunakan query builder
        $pengajuan_surats = DB::table('pengajuan_surats')
            ->join('master_surats', 'pengajuan_surats.id_surat', '=', 'master_surats.id_surat')
            ->join('master_masyarakats', 'pengajuan_surats.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('master_kks', 'master_masyarakats.id', '=', 'master_kks.id')
            ->where(function ($query) use ($id_masyarakat, $no_kk) {
                $query->where('pengajuan_surats.id_masyarakat', $id_masyarakat)
                    ->orWhere('master_kks.no_kk', '=', $no_kk);
            })
            ->where('pengajuan_surats.status',  $status)
            ->select('pengajuan_surats.*', 'master_masyarakats.*', 'master_surats.*')
            ->get();

        return response()->json([
            'message' => 'success',
            'data' => $pengajuan_surats
        ], 200);
    }

    public function statusditolak(Request $request)
    {
        $user = $request->user();
        $id_masyarakat = $user->id_masyarakat;


        $no_kk = MobileMasterKksModel::whereHas('masyarakat', function ($query) use ($id_masyarakat) {
            $query->where('id_masyarakat', $id_masyarakat);
        })->value('no_kk');

        // menggunakan query builder
        $pengajuan_surats = DB::table('pengajuan_surats')
            ->join('master_surats', 'pengajuan_surats.id_surat', '=', 'master_surats.id_surat')
            ->join('master_masyarakats', 'pengajuan_surats.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('master_kks', 'master_masyarakats.id', '=', 'master_kks.id')
            ->where(function ($query) use ($id_masyarakat, $no_kk) {
                $query->where('pengajuan_surats.id_masyarakat', $id_masyarakat)
                    ->orWhere('master_kks.no_kk', '=', $no_kk);
            })
            ->whereIn('pengajuan_surats.status', ['Ditolak RT', 'Ditolak RW'])
            ->select('pengajuan_surats.*', 'master_masyarakats.*', 'master_surats.*')
            ->get();

        return response()->json([
            'message' => 'success',
            'data' => $pengajuan_surats
        ], 200);
    }

    public function pembatalan(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'id_surat' => 'required',
        ]);
        $masyarakat = MobileMasterMasyarakatModel::where('nik', $request->nik)->first();

        if (!$masyarakat) {
            return response()->json([
                'message' => 'Nik tidak ditemukan',
            ], 400);
        }
        $existingSurat = MobilePengajuanSuratModel::where('id_surat', $request->id_surat)
            ->where('id_masyarakat', $masyarakat->id_masyarakat)
            ->first();
        if (!$existingSurat) {
            return response()->json([
                'message' => 'Surat tidak ditemukan',
            ], 400);
        }

        // Update the status of the record
        $pengajuan_surat = MobilePengajuanSuratModel::where('id_surat', $request->id_surat)
            ->where('id_masyarakat', $masyarakat->id_masyarakat)
            ->where('status', 'Diajukan')
            ->update(['status' => 'Dibatalkan']);

        if ($pengajuan_surat) {
            return response()->json([
                'message' => 'Surat berhasil dibatalkan',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Tidak ada surat dengan status Diajukan yang dapat dibatalkan',
            ], 400);
        }
    }
}
