<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knights', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age')->default(0);
            $table->string('picture_url')->nullable();
            $table->integer('courage')->default(0);
            $table->integer('justice')->default(0);
            $table->integer('mercy')->default(0);
            $table->integer('generosity')->default(0);
            $table->integer('faith')->default(0);
            $table->integer('nobality')->default(0);
            $table->integer('hope')->default(0);
            $table->integer('strength')->default(0);
            $table->integer('defense')->default(0);
            $table->integer('battle_strategy')->default(0);
            $table->integer('health')->default(100);
            $table->integer('damage')->default(0);
            $table->boolean('is_winner')->default(false);
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
        Schema::dropIfExists('knights');
    }
}
