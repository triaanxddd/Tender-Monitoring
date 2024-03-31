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
        Schema::create('demanded_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('goods_id')
                ->references('id')
                ->on('goods')
                ->constrained('goods')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('quantity');
            $table->foreignId('task_id')
                ->references('id')
                ->on('tasks')
                ->constrained('tasks')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->boolean('approval')->default(0);
            
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
        Schema::dropIfExists('demanded_goods');
    }
};
