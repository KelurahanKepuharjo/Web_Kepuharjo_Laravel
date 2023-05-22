<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengajuan_surat extends Model
{
    protected $table = 'pengajuan_surats';

    public function pengajuan()
    {
        return $this->join('master_surats', 'pengajuan_surats.id_surat', '=', 'master_surats.id_surat')
            ->join('master_masyarakats', 'master_masyarakats.id_masyarakat', '=', 'pengajuan_surats.id_masyarakat')
            // ->join('master_akuns','master_akuns.id_masyarakat','=', 'master_masyarakats.id_masyarakat')
            ->join('master_kks', 'master_masyarakats.id', '=', 'master_kks.id')

            ->select('master_kks.*', 'master_masyarakats.*', 'pengajuan_surats.id', 'pengajuan_surats.status', 'pengajuan_surats.keterangan', 'pengajuan_surats.created_at', 'master_surats.id_surat', 'master_surats.nama_surat');
    }
}
