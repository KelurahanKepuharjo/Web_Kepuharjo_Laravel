<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterMasyarakatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_masyarakats', function (Blueprint $table) {
            $table->bigInteger('nik')->primary();
            $table->uuid('uuid');
            $table->string('nama_lengkap', 100)->nullable()->default('text');
            $table->string('jenis_kelamin', 16)->nullable()->default('text');
            $table->string('tempat-lahir', 50)->nullable()->default('text');
            $table->date('tgl_lahir');
            $table->string('agama', 20)->nullable()->default('text');
            $table->string('pendidikan', 20)->nullable()->default('text');
            $table->string('pekerjaan', 60)->nullable()->default('text');
            $table->string('golongan_darah', 12)->nullable()->default('text');
            $table->string('status_perkawinan', 20)->nullable()->default('text');
            $table->date('tgl_perkawinan');
            $table->string('status_keluarga', 20)->nullable()->default('text');
            $table->string('kewarganegaraan', 20)->nullable()->default('text');
            $table->integer('no_paspor')->unsigned()->nullable()->default(12);
            $table->integer('no_kitab')->unsigned()->nullable()->default(12);
            $table->string('nama_ayah', 60)->nullable()->default('text');
            $table->string('nama_ibu', 60)->nullable()->default('text');
            $table->unsignedBigInteger('id');
            // $table->Foreign('id')->references('id')->on('master_kks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_masyarakats');
    }
}