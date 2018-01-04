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
<<<<<<< HEAD
                    'password' => 'B$Cc3U^V'
=======
                    'password' => '123456'
>>>>>>> 5e46b170fd076f69529943a6bb928b7b96b6a2dc
        ]);
    }

}
