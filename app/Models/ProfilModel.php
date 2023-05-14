<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilModel extends Model
{
    protected $table = 'master_masyarakats';

    public function profile()
    {
        return $this->join('master_akuns', 'master_masyarakats.id_masyarakat', 'master_akuns.id_masyarakat')
            ->select('master_akuns.image');
    }
}
