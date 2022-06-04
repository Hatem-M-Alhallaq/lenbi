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
        Schema::create('phase2s', function (Blueprint $table) {
            $table->id();
            $table->integer('app_id');
            $table->string('full_namme');
            $table->integer('id_number');
            $table->integer('owner_precentage');
            $table->string('dab');
            $table->string('spouse_name');
            $table->string('spouse_id');
            $table->string('spouse_ocupation');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->integer('is_owned_house');
            $table->integer('amount');
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
        Schema::dropIfExists('phase2s');
    }
};
