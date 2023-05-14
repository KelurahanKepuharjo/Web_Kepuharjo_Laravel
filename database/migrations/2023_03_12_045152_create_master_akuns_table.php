<?php

use Illuminate\Database\Migrations\Migration;
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
            $table->uuid('id')->primary();
            $table->string('password', 255)->nullable()->default('text');
            $table->Biginteger('no_hp')->nullable()->default(13);
            $table->string('role', 12)->nullable()->default('text');
            $table->timestamps();
            $table->uuid('id_masyarakat');
            $table->Foreign('id_masyarakat')->references('id_masyarakat')->on('master_masyarakats');
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
