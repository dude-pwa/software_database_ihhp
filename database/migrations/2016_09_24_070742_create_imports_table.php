<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tahun');
            $table->string('hscode');
            $table->string('nama_item');
            $table->string('kode_negara');
            $table->string('nama_negara');
            $table->string('kode_pelabuhan');
            $table->string('nama_pelabuhan');
            $table->string('berat_bersih');
            $table->string('nilai');
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
        Schema::drop('imports');
    }
}
