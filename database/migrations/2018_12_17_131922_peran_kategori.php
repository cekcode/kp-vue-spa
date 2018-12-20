<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PeranKategori extends Migration
{

    public function up()
    {
        Schema::create('peran_kategori', function (Blueprint $table) {
            $table->integer('kategori_id')->unsigned()->index();
            $table->integer('peran_id')->unsigned()->index();
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
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
        //
    }
}
