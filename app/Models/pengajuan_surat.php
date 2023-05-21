<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengajuan_surat extends Model
{
    protected $table = 'pengajuan_surats';

    public function pengajuan()
    {
        return $this->join('master_masyarakats','master_masyarakats.id_masyarakat','pengajuan_surats.id_masyarakat')
            ->join('master_surats', 'master_surats.id_surat', 'pengajuan_surats.id_surat')
            ->join('master_kks', 'master_kks.id', 'master_masyarakats.id')
            ->select('master_kks.*', 'master_masyarakats.*', 'pengajuan_surats.status', 'pengajuan_surats.keterangan', 'pengajuan_surats.created_at', 'master_surats.id_surat', 'master_surats.nama_surat');
    }
}