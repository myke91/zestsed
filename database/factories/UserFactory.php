<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Registration::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'otherNames' => $faker->word,
        'email' => $faker->unique()->safeEmail,
        'phoneNumber' => $faker->phoneNumber,
        'gender' => $faker->word,
        'nextOfKin' => $faker->word,
        'occupation' => $faker->word,
        'isApproved' =>$faker->boolean(),
        'dateOfApproval' =>\Carbon\Carbon::parse('+1 week'),

    ];
});

$factory->define(App\Contribution::class, function (Faker $faker) {
    return [
        'userId' =>App\Registration::all()->random()->registrationId,
        'modeOfPayment' => $faker->word,
        'sourceOfPayment' => $faker->word,
        'contributionAmount' => "50.0",
        'vendorName' => $faker->word,
        'dateOfContribution' => \Carbon\Carbon::parse('+1 week'),
        'isApproved' =>$faker->boolean(),
        'dateOfApproval' =>\Carbon\Carbon::parse('+1 week'),

    ];
});

$factory->define(App\Investment::class, function (Faker $faker) {
    return [
        'contributionId' =>App\Contribution::all()->random()->contributionId,
        'interestRate' => "1",
        'dateOfInvestment' => \Carbon\Carbon::parse('+1 week'),

    ];
});
