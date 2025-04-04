<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameDateAndTitleInMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Rename 'date' to 'tanggal' and 'title' to 'nama_rapat'
        Schema::table('meetings', function (Blueprint $table) {
            $table->renameColumn('date', 'tanggal');
            $table->renameColumn('title', 'nama_rapat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert the changes (rename 'tanggal' back to 'date' and 'nama_rapat' back to 'title')
        Schema::table('meetings', function (Blueprint $table) {
            $table->renameColumn('tanggal', 'date');
            $table->renameColumn('nama_rapat', 'title');
        });
    }
}
