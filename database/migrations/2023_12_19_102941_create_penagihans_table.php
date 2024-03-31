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
        Schema::create('penagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')
                    ->references('id')
                    ->on('tasks')
                    ->constrained('tasks')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->string('file')->nullable();
            $table->string('user_name')->nullable();
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
        Schema::dropIfExists('penagihans');
    }
};
