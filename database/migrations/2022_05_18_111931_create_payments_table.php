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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('app_id');
            $table->integer('payment_type');
            $table->integer('card_id');
            $table->string('expire');
            $table->string('cvv');
            $table->integer('status');
            $table->string('date');
            $table->string('card_holder_name');
            $table->string('card_holder_id');
            $table->integer('transaction_id');
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
        Schema::dropIfExists('payments');
    }
};
