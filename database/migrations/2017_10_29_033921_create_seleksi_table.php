<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeleksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seleksi', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->string('peminatan')->nullable();
            $table->string('berkas')->nullable();
            $table->string('status')->default('Belum Diverifikasi');
            $table->string('lulus_berkas')->default('Tidak')->nullable();
            $table->string('lulus_wawancara')->default('Tidak')->nullable();
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seleksi');
    }
}
