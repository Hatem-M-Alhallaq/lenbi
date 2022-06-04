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
        Schema::create('phase9s', function (Blueprint $table) {
            $table->id();
            $table->integer('app_id');
            $table->string('start_work_estimated_time');
            $table->integer('expected_revenue');
            $table->integer('cost');
            $table->integer('fuel');
            $table->integer('sales_worker');
            $table->integer('Subcontractor');
            $table->integer('consumables');
            $table->integer('trucking');
            $table->integer('another_cost');
            $table->integer('total_sales_cost');
            $table->integer('gross_profit');
            $table->integer('salary');
            $table->integer('rent');
            $table->integer('electricity_water_gas');
            $table->integer('insurance');
            $table->integer('keeping');
            $table->integer('offices');
            $table->integer('phone');
            $table->integer('maintenance');
            $table->integer('publication');
            $table->string('depreciation');
            $table->integer('total_administrative_financial_expenses');
            $table->integer('profit');
            $table->integer('bank_fees');
            $table->integer('non_profit');
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
        Schema::dropIfExists('phase9s');
    }
};
