<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment', function (Blueprint $table) {
            $table->increments('investmentId');
            $table->integer('memberId')->unsigned();
            $table->string('quotaMonth');
            $table->string('quotaYear');
            $table->string('cycleMonth')->nullable();
            $table->string('cycleYear')->nullable();
            $table->decimal('quotaAmount',12,2)->default(0.00);
            $table->decimal('quotaRollover',12,2)->default(0.00);
            $table->decimal('quotaWithInterest',12,2)->default(0.00);
            $table->decimal('interestAmount',12,2)->default(0.00);
            $table->decimal('cumulativeInterest',12,2)->default(0.00);
            $table->foreign('memberId')->references('registrationId')->on('registration');
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
        Schema::dropIfExists('investment');
    }
}
