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
        Schema::create('phase8s', function (Blueprint $table) {
            $table->id();
            $table->integer('app_id');
            $table->integer('currency_id');
            $table->integer('expected_balance');
            $table->integer('growth_percentage_y_2');
            $table->integer('growth_percentage_y_3');
            $table->string('expectation');
            $table->string('attachments');
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
        Schema::dropIfExists('phase8s');
    }
};
