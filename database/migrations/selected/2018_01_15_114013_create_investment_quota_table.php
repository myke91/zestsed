<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestmentQuotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_quota', function (Blueprint $table) {
            $table->increments('iq_id');
            $table->integer('member_id')->unsigned();
            $table->string('quota_month');
            $table->string('quota_year');
            $table->decimal('quota_amount',12,2);
            $table->decimal('quota_rollover',12,2);
            $table->decimal('quota_with_interest',12,2);
            $table->decimal('interest_amount',12,2);
            $table->decimal('cummulative_interest',12,2);
            $table->foreign('member_id')->references('registrationId')->on('registration');
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
        Schema::dropIfExists('investment_quota');
    }
}
