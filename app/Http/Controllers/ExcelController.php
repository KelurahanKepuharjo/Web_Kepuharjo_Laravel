<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\PengajuanModel;
use Carbon\Carbon;

class ExcelController extends Controller
{
    public function export()
    {
        $currentMonth = Carbon::now()->format('F');
        $currentYear = Carbon::now()->format('Y');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $pengajuan = new PengajuanModel();
        $data = $pengajuan->pengajuan()
            ->where('pengajuan_surats.status', '=', 'Selesai')
            ->get();
        // Isi data ke dalam Spreadsheet
        $sheet->setCellValue('A1', 'Nama Kolom 1');
        $sheet->setCellValue('B1', 'Nama Kolom 2');
        // ...

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->nama_lengkap);
            $sheet->setCellValue('B' . $row, $item->agama);
            // ...

            $row++;
        }

        // Simpan Spreadsheet ke file
        $writer = new Xlsx($spreadsheet);
        $filename = 'Rekapan Pengajaun Bulan_'.$currentMonth.'_'.$currentYear.'.xlsx';
        $writer->save($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
