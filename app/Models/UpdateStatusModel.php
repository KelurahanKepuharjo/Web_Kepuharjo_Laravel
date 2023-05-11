<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateStatusModel extends Model
{
    protected $table = 'master_masyarakats';

    public function UpdateStatus()
    {
        return $this->join('master_akuns', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
            ->join('pengajuan_surats', 'pengajuan_surats.id', 'master_akuns.id')
            ->select('master_masyarakats.*', 'master_akuns.*', 'pengajuan_surats.id_pengajuan');
    }
}