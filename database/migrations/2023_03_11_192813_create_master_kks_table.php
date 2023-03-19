<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kks', function (Blueprint $table) {
            
            $table->id();
            $table->uuid('uuid');            
            $table->bigInteger('no_kk' ,)->nullable()->default(12);
            $table->string('nama_kepala_keluarga', 100)->nullable()->default('text');
            $table->string('alamat', 100)->nullable()->default('text');
            $table->tinyInteger('rt');
            $table->tinyInteger('rw');
            $table->smallInteger('kode_pos');
            $table->string('kelurahan', 60)->nullable()->default('text');
            $table->string('kecamatan', 60)->nullable()->default('text');
            $table->string('kabupaten', 60)->nullable()->default('text');
            $table->string('provinsi', 60)->nullable()->default('text');
            $table->date('kk_tgl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_kks');
    }
}
