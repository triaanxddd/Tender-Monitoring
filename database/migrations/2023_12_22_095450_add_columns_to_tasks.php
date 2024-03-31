<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('harga_kontrak')->nullable();
            $table->string('harga_perkiraan_sendiri')->nullable();
            $table->string('harga_pagu')->nullable();
            $table->string('harga_upload')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('harga_kontrak');
            $table->dropColumn('harga_perkiraan_sendiri');
            $table->dropColumn('harga_pagu');
            $table->dropColumn('harga_upload');

        });
    }
};
