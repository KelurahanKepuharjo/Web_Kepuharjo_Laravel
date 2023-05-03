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
            $table->uuid('id')->primary();
            $table->string('image', 30)->nullable()->default('text');
            $table->string('password', 255)->nullable()->default('text');
            $table->Biginteger('no_hp')->nullable()->default(13);
            $table->string('role', 12)->nullable()->default('text');
            $table->string('status', 12)->nullable()->default('text');
            $table->timestamps();
            $table->uuid('id_masyarakat');
            $table->Foreign('id_masyarakat')->references('id_masyarakat')->on('master_masyarakats');
            // $table->Foreign('id_masyarakat')->references('id_masyarakat')->on('master_masyarakats')->constrained('master_akuns')->cascadeOnDelete()->cascadeOnUpdate();

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