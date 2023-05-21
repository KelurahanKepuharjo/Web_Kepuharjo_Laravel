<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PdfModel extends Model
{
    protected $table = 'master_kks';

    public function pengajuan()
    {

        return $this->join('master_masyarakats.id','master_kks.id','master_masayarakats.id')
        ->join('pengajuan_surats','pengajuan_surats.id_masyarakat','master_masyarakats.id_masyarakat')
        ->join('master_surats','master_surats.id_surat','pengajuan_surats.id_surat');
        // return $this
        // ->join('master_masyarakats', 'master_masyarakats.id_masyarakat', '=', 'pengajuan_surats.id_masyarakat')
        // ->join('master_kks', 'master_masyarakats.id', '=', 'master_kks.id')
        // ->join('master_surats', 'pengajuan_surats.id_surat', 'master_surats.id_surat')
        // ->select('master_kks.no_kk', 'master_kks.alamat', 'master_kks.rt', 'master_kks.rw', 'master_kks.kode_pos', 'master_kks.kelurahan', 'master_kks.kecamatan', 'master_kks.kabupaten', 'master_kks.provinsi', 'master_kks.kk_tgl', 'master_masyarakats.*', 'pengajuan_surats.id', 'pengajuan_surats.created_at', 'pengajuan_surats.updated_at', 'master_surats.*');
    }
}