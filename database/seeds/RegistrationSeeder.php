<?php

use Illuminate\Database\Seeder;
use App\Registration;

class RegistrationSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Registration::insert(
                [
                    [
                        'firstName' => 'kweku',
                        'lastName' => 'one',
                        'otherNames' => 'amissah',
                        'gender' => 'Male',
                        'email' => 'kweku@one.com',
                        'phoneNumber' => '0234343332',
                        'nextOfKin' => 'Esi Two',
                        'nextOfKinTelephone' => '0234343221',
                        'residentialAddress' => 'HI 443434',
                        'occupation' => 'Teacher',
                        'purposeOfInvesting' => 'To Further Education',
                        'isApproved' => true,
                        'dateOfApproval' => '1990-01-12'
                    ]
        ]);
    }

}
