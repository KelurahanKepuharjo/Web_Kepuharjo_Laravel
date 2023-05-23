<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileMasterSuratModel extends Model
{
    protected $table = 'master_surats';
    protected $fillable = ['*'];

    public function pengajuan_surats()
    {
        return $this->hasMany(MobilePengajuanSuratModel::class, 'id_surat', 'id_surat');
    }
}
