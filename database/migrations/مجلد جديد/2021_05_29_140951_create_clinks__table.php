<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 225);
            $table->date('Expiry_of_subscription');
            $table->string('email')->unique();
            $table->string('address', 45);
            $table->string('password');
            $table->integer('mobile');
            $table->string('Username');
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
        Schema::dropIfExists('clinks');
    }
}
