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
        Schema::create('phase1s', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->integer('is_completed');
            $table->string('company_name');
            $table->string('company_number');
            $table->string('bank_name');
//            $table->string('app_prepare');
//            $table->string('phone_number');
            $table->string('submit_date');
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
        Schema::dropIfExists('phase1s');
    }
};
