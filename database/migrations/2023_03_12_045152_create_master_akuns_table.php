<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_akuns', function ($table) {
            $table->id();
            $table->string('nama', 100)->nullable()->default('text');
            $table->uuid('uuid');
            $table->string('password', 20)->nullable()->default('text');
            $table->string('role', 20)->nullable()->default('text');
            $table->timestamps();
            $table->BigInteger('nik');
            // $table->Foreign('nik')->references('nik')->on('master_masyarakats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_akuns');
    }
}