<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class surat extends Model
{
    protected $table = 'master_surats';

    protected $primaryKey = 'id_surat';

    protected $fillable = ['id_surat', 'nama_surat'];
}
