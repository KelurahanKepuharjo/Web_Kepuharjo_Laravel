<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_masyarakat extends Model
{
    protected $table = 'master_masyarakats';
    protected $primary_key = 'id';
    protected $fillable = ['*'];
    // public function master_masyarakat(){
    // return $this->belongsTo(master_masyarakat::class);
    // }
}