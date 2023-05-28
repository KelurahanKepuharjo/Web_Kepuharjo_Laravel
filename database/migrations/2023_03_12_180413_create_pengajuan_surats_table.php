<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_surats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->String('nomor_surat')->nullable()->default('');
            $table->string('status', 20)->nullable()->default('text');
            $table->text('keterangan')->nullable()->default('text');
            $table->timestamps();
            $table->string('file_pdf')->nullable()->default('');
            $table->string('image_kk')->nullable()->default('');
            $table->string('image_bukti')->nullable()->default('');
            $table->enum('info', ['active', 'non_active']);
            $table->uuid('id_masyarakat');
            $table->Foreign('id_masyarakat')->references('id_masyarakat')->on('master_masyarakats');
            $table->smallInteger('id_surat');
            $table->Foreign('id_surat')->references('id_surat')->on('master_surats');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_surats');
    }
}
