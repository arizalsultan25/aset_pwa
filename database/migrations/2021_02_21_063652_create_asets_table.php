<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_aset');
            $table->string('jenis');
            $table->string('merk');
            $table->text('deskripsi');
            $table->enum('divisi', ['IT Support', 'Finance', 'Production', 'Human Resource'])->default('IT Support');
            $table->enum('status', ['baik','rusak'])->default('baik');
            $table->string('qr', 16)->unique();
            $table->string('gambar')->default(null)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asets');
    }
}
