<?php

namespace App\Http\Controllers;
use App\Models\PdfModel;
use App\Models\UpdateStatusModel;
use FPDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{   public function generatePDF(Request $request, $id)
    {
        $pdf = new FPDF();
        $pdf->AddPage();

        $pengajuan = new PdfModel();
        $data = $pengajuan->pengajuan()
            ->where('pengajuan_surats.id', '=', $id)
            // ->where('nik', '=', $request->nik)
            ->get();
        $data->update([
            'pengajuan_surats.status' => "Selesai",
            'pengajuan_surats.file_pdf' => $data->nama_lengkap.'_'.$data->nik.'_'.'_'.$id.'.pdf'
        ]);

            // dd($data);
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

                $pdf->Output($user->nama_lengkap.'_'.$user->nik.'_'.'_'.$id.'.pdf', 'I');
                exit;
        }



            // $updatestatus = new UpdateStatusModel();
            // $dataupdate = $updatestatus->UpdateStatus()
            //     ->where('pengajuan_surats.id', $id)
            //     ->first();
            // $dataupdate->update([
            //     'pengajuan_surats.status' => "Selesai",
            //     'pengajuan_surats.file_pdf' => $data->nama_lengkap.'_'.$data->nik.'_'.'_'.$id.'.pdf'
            // ]);

            // return redirect('/suratmasuk')->with('successedit', '');


        // $pdf->Output('I', 'example.pdf');
        // $pdf->Output();
        // $pdf->Output(public_path('example.pdf'), 'F');
    }
}
