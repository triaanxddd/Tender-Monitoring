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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->references('id')
                  ->on('users')
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->string('name');
            $table->date('tanggal_upload');
            $table->json('penjelasan')->nullable();
            $table->json('upload_dokumen')->nullable();
            $table->json('undangan_pelelangan')->nullable();
            $table->json('teknis')->nullable();
            $table->json('penawaran')->nullable();
            $table->json('legal')->nullable();
            $table->json('pengumuman_pem')->nullable();
            $table->integer('barang')->nullable();
            $table->smallInteger('status_pemenang')->nullable()->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
