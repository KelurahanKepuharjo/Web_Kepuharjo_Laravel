<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilePengajuanSuratModel extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_surats';
    protected $fillable = ['id_masyarakat', 'id_surat', 'keterangan', 'created_at', 'uuid', 'status', 'file_pdf'];
    public $timestamps = false;


    public function akun()
    {
        return $this->belongsTo(MobileMasterMasyarakatModel::class, 'id_masyarakat', 'id_masyarakat');
    }

    public function surat()
    {
        return $this->belongsTo(MobileMasterSuratModel::class, 'id_surat', 'id_surat');
    }
}
