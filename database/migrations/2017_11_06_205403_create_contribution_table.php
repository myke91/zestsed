<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributionTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contribution', function (Blueprint $table) {
            $table->increments('contributionId');
            $table->string('modeOfPayment');
            $table->string('sourceOfPayment');
            $table->string('vendorName');
            $table->date('dateOfContribution');
            $table->decimal('contributionAmount', 10, 2);
            $table->boolean('isApproved')->default(false);
            $table->date('dateOfApproval')->nullable();;
            $table->integer('userId')->unsigned();
            $table->foreign('userId')->references('registrationId')->on('registration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contribution');
    }

}
