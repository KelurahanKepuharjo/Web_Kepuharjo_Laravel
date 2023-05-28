<?php

namespace App\Http\Controllers;

use App\Models\PengajuanModel;
use App\Models\UpdateStatusModel;
use Illuminate\Http\Request;
use App\Models\MobileMasterKksModel;
use App\Models\MobileMasterMasyarakatModel;
use FPDF;

class PengajuanController extends Controller
{
    public function surat_masuk()
    {
        if (session('hak_akses') == 'admin') {
            $pengajuan = new PengajuanModel();
            $data = $pengajuan->pengajuan()
                ->where('pengajuan_surats.status', '=', 'Disetujui RW')
                ->get();

        } elseif (session('hak_akses') == 'RT') {
            $RT = session('rt');
            $RW = session('rw');
            $pengajuan = new PengajuanModel();
            $data = $pengajuan->pengajuan()
                ->where('pengajuan_surats.status', '=', 'Diajukan')
                ->where('master_kks.RT', '=', $RT)
                ->where('master_kks.RW', '=', $RW)
                ->get();
        } elseif (session('hak_akses') == 'RW') {
            $RW = session('rw');
            $pengajuan = new PengajuanModel();
            $data = $pengajuan->pengajuan()
                ->where('pengajuan_surats.status', '=', 'Disetujui RT')
                ->where('master_kks.RW', '=', $RW)
                ->get();
        }

        return view('surat_masuk', compact('data'));
    }

    public function update_statustolak(Request $request, $id, $akses)
    {
        if ($akses == 'RT') {
            $status = 'Ditolak RT';
        } elseif ($akses == 'RW') {
            $status = 'Ditolak RW';
        }
            $updatestatus = new UpdateStatusModel();
            $data = $updatestatus->UpdateStatus()
                ->where('pengajuan_surats.id', $id)
                ->first();
            $data->update([
                'pengajuan_surats.status' => $status,
            ]);
        return redirect('/suratmasuk')->with('successedit', '');
    }

    public function update_status(Request $request, $id, $akses)
    {
        if ($akses == 'RT') {
            $status = 'Disetujui RT';
            $updatestatus = new UpdateStatusModel();
            $data = $updatestatus->UpdateStatus()
                ->where('pengajuan_surats.id', $id)
                ->first();
            $data->update([
                'pengajuan_surats.status' => $status,
            ]);
            return redirect('/suratmasuk')->with('successedit', '');
        } elseif ($akses == 'RW') {
            $status = 'Disetujui RW';
            $updatestatus = new UpdateStatusModel();
            $data = $updatestatus->UpdateStatus()
                ->where('pengajuan_surats.id', $id)
                ->first();
            $data->update([
                'pengajuan_surats.status' => $status,
            ]);
            return redirect('/suratmasuk')->with('successedit', '');
        } elseif ($akses == 'admin') {
            $status = 'Selesai';
            $file_pdf = 'sktm.pdf';

            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->Image('image/logohp.png', 18, 27, 43, 0, 'PNG');
            // $pdf->SetFont('Arial','B',12);
            $pdf->SetFont('Times', '', 12);
            $pdf->SetXY(30, 24);

            // Add a multi-line cell with a left indentation of 20mm
            $pdf->MultiCell(0, 6, '
            P E M E R I N T A H   K A B U P A T E N  L U M A J A N G
            KECAMATAN LUMAJANG
            KELURAHAN KEPUHARJO
            Jl. Langsep No. 18 Telp. (0334) 888243
            L U M A J A N G

            ',
                0, 'C', false, 20);

            $outputPath = public_path('pdf/sktm.pdf');
            $pdf->Output($outputPath, 'F');

            $updatestatus = new UpdateStatusModel();
            $data = $updatestatus->UpdateStatus()
                ->where('pengajuan_surats.id', $id)
                ->first();
            $data->update([
                'pengajuan_surats.status' => $status,
                'file_pdf' => $file_pdf,
            ]);
            return redirect('/suratmasuk')->with('successedit', '');
        }
    }

    public function surat_ditolak()
    {
        if (session('hak_akses') == 'RT') {
            $RT = session('rt');
            $RW = session('rw');
            $pengajuan = new PengajuanModel();
            $data = $pengajuan->pengajuan()
                ->where('pengajuan_surats.status', '=', 'Ditolak RT')
                ->where('master_kks.RT', '=', $RT)
                ->where('master_kks.RW', '=', $RW)
                ->get();
        } elseif (session('hak_akses') == 'RW') {
            $RW = session('rw');
            $hak_akses = session('hak_akses');
            $pengajuan = new PengajuanModel();
            $data = $pengajuan->pengajuan()
                ->where('pengajuan_surats.status', '=', 'Ditolak RW')
                ->where('master_kks.RW', '=', $RW)
                ->get();
        }

        return view('surat_ditolak', compact('data'));
    }

    public function surat_selesai()
    {
        if (session('hak_akses') == 'admin') {
            $pengajuan = new PengajuanModel();
            $data = $pengajuan->pengajuan()
                ->where('pengajuan_surats.status', '=', 'Selesai')
                ->get();

        // dd($data);
        } elseif (session('hak_akses') == 'RT') {
            $RT = session('rt');
            $RW = session('rw');
            $pengajuan = new PengajuanModel();
            $data = $pengajuan->pengajuan()
                ->where('master_kks.RT', '=', $RT)
                ->where('master_kks.RW', '=', $RW)
                ->where('pengajuan_surats.status', '=', 'Disetujui RT')
                ->orWhere('pengajuan_surats.status', '=', 'Disetujui RW')
                ->orWhere('pengajuan_surats.status', '=', 'Selesai')
                ->get();

        } elseif (session('hak_akses') == 'RW') {
            $RW = session('rw');
            $pengajuan = new PengajuanModel();
            $data = $pengajuan->pengajuan()
                ->where('master_kks.RW', '=', $RW)
                ->Where('pengajuan_surats.status', '=', 'Disetujui RW')
                ->orWhere('pengajuan_surats.status', '=', 'Selesai')
                ->get();

        }

        return view('surat_selesai', compact('data'));
    }
}
