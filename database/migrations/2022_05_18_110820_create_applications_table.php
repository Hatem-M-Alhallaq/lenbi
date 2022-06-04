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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('app_type');
            $table->integer('status');
            $table->string('start_date');
            $table->string('submit_date');
            $table->integer('payment_status');
            $table->integer('payment_type');
            $table->integer('payment_id');
            $table->integer('reviewed_by');
            $table->integer('is_downloaded');
            $table->integer('is_public');
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
        Schema::dropIfExists('applications');
    }
};
