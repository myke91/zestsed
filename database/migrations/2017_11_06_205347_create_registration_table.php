<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('registration', function (Blueprint $table) {
            $table->increments('registrationId');
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('otherNames')->nullable();
            $table->string('gender')->nullable();
            $table->string('email',100)->unique();
            $table->string('phoneNumber')->nullable();
            $table->string('nextOfKin')->nullable();
            $table->string('nextOfKinTelephone')->nullable();
            $table->string('residentialAddress')->nullable();
            $table->string('occupation')->nullable();
            $table->string('purposeOfInvesting')->nullable();
            $table->boolean('isApproved')->default(false);
            $table->date('dateOfApproval')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('registration');
    }

}
