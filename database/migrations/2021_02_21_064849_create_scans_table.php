<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_jadwal');
            $table->unsignedBigInteger('id_aset');
            $table->enum('status',['belum discan', 'telah discan'])->default('belum discan');
            $table->timestamps();

            // foreign key
            $table->foreign('id_jadwal')->references('id')->on('jadwal_scans')->onDelete('cascade');;
            $table->foreign('id_aset')->references('id')->on('asets')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scans');
    }
}
