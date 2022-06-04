<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('Company');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('mobile');
            $table->integer('emirates_id');
            $table->string('email');
            $table->string('image');
            $table->enum('status', ['active', 'block']);
            $table->foreignId('clink_id');
            $table->foreign('clink_id')->references('clinks')->on('id')->onDelete('cascade');
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
        Schema::dropIfExists('members');
    }
}
