<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RwaksesModal extends Model
{
    protected $table = 'master_kks';

    public function rw()
    {
        return $this->join('master_masyarakats', 'master_masyarakats.id', '=', 'master_kks.id')
            ->join('master_akuns', 'master_masyarakats.id_masyarakat', 'master_akuns.id_masyarakat')
            ->select('master_kks.*', 'master_masyarakats.*', 'master_akuns.*');
    }
}
