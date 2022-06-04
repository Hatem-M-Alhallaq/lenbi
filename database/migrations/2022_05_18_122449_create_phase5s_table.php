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
        Schema::create('phase5s', function (Blueprint $table) {
            $table->id();
            $table->integer('app_id');
            $table->string('business_idea');
            $table->string('experiences');
            $table->string('description');
            $table->string('location');
            $table->string('why');
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
        Schema::dropIfExists('phase5s');
    }
};
