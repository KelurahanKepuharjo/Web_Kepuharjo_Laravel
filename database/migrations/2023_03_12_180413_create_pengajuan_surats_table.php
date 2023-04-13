<?php

use App\Models\master_akun;
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
            $table->integerIncrements('id_pengajuan');
            $table->uuid('uuid');
            $table->string('status', 20)->nullable()->default('text');
            $table->text('keterangan')->nullable()->default('text');
            $table->dateTime('created_at', $precision = 0);
            // $table->bigInteger('id')->unsigned();
            $table->uuid('id');
            $table->Foreign('id')->references('id')->on('master_akuns');
            $table->smallInteger('id_surat');
            $table->foreign('id_surat')->references('id_surat')->on('master_surats')->onDelete('cascade');

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