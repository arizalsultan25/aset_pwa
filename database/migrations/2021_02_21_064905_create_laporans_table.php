<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_aset');
            $table->text('detail');
            $table->string('gambar');
            $table->enum('status',['belum ditanggapi','diterima','ditolak']);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // foreign key
            $table->foreign('id_aset')->references('id')->on('asets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporans');
    }
}
