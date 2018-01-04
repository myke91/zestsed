<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::create(
                [
                    'name' => 'Super Admin',
                    'username' => 'admin',
                    'email' => 'admin@zestsedgh.com',
                    'password' => '123456'
        ]);
    }

}
