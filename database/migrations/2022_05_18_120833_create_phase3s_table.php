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
        Schema::create('phase3s', function (Blueprint $table) {
            $table->id();
            $table->integer('app_id');
            $table->integer('have_you_prvieos');
            $table->integer('credit_history');
            $table->integer('have_execution');
            $table->integer('is_completed');
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
        Schema::dropIfExists('phase3s');
    }
};
