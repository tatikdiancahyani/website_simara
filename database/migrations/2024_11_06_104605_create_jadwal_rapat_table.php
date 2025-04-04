<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalRapatTable extends Migration
{
    public function up()
    {
        Schema::create('jadwal_rapat', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('tempat');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_rapat');
    }
}
