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

            $pengajuan = new PengajuanModel();
            $data = $pengajuan->pengajuan()->where('pengajuan_surats.id', '=', $id)->get();


                
            $data = MobileMasterMasyarakatModel::where('id_masyarakat', '=', $user->id_masyarakat)
            ->select('id')
            ->get();
            foreach ($data as $user) {
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

                $pdf->SetFont('Times', 'B', 14);
                $pdf->SetXY(20, 66);

                // Add a multi-line cell with a left indentation of 20mm
                $pdf->MultiCell(0, 6, "SURAT KETERANGAN $user->nama_surat
                ",
                    0, 'C', false, 20);

                $pdf->SetFont('Times', '', 12);
                $pdf->SetXY(20, 72);

                // Add a multi-line cell with a left indentation of 20mm
                $pdf->MultiCell(0, 6, 'NOMOR :
                ',
                    0, 'C', false, 20);

                $pdf->SetFont('Times', '', 12);
                $pdf->SetXY(20, 84);
                $pdf->MultiCell(0, 6, '             Yang bertanda tangan di bawah ini kami Lurah Kepuharjo Kecamatan Lumajang Kabupaten Lumajang menerangkan bahwa : ',
                    0, 'L', false, 20);

                $pdf->SetXY(42, 102);
                $pdf->MultiCell(0, 6, "            Nama                            : $user->nama_lengkap
                Tempat,Tgl Lahir         : $user->tempat_lahir ,$user->tgl_lahir
                Jenis Kelamin               : $user->jenis_kelamin
                Kebangsaan / Agama    : $user->kewarganegaraan , $user->agama
                Status 	                          : $user->status_perkawinan
                Pekerjaan 	                    : $user->pekerjaan
                NIK	                              : $user->nik
                Alamat 	                        : $user->alamat
                ",
                    0, 'L', false, 20);
                $pdf->Image('image/stempel.png', 120, 216, 33, 0, 'PNG');
                $pdf->Image('image/ttd.png', 110, 220, 40, 0, 'PNG');
                $pdf->SetXY(20, 156);
                $pdf->MultiCell(0, 6, "             Kelurahan Kepuharjo Kecamatan Lumajang

                            Adalah benar sampai dengan saat ini warga kami dan berdasarkan Surat pengantar Nomer. ((nomor Surat))   Tanggal, ((Tgl Surat)) dan pengakuannya. Bahwa nama yang tersebut diatas benar keluarga tidak mampu. Surat keterangan ini hanya dipergunakan untuk

                            Demikian surat keterangan ini kami buat untuk dapat dipergunakan sebagaimana mestinnya.


                                                                                                    Lumajang, $user->created_at
                                                                                                    LURAH KEPUHARJO




                                                                                                    MUHAMMAD SAIFUL,S.AP
                                                                                                    NIP. 19720202 199803 1 010

                        ",
                    0, 'L', false, 20);
                    $pdf->Output(public_path('pdf/'.$user->nama_lengkap.'_'.$user->nik.'_'.$user->nama_surat.'.pdf', 'F'));
                    // $pdf->Output($user->nama_lengkap.'_'.$user->nik.'_'.$user->nama_surat.'.pdf', 'D');

                $updatestatus = new UpdateStatusModel();
                $data = $updatestatus->UpdateStatus()
                    ->where('pengajuan_surats.id', $id)
                    ->first();
                $data->update([
                    'pengajuan_surats.status' => $status,
                    'file_pdf' => $user->nama_lengkap.'_'.$user->nik.'_'.$user->nama_surat.'.pdf',
                ]);
            }

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