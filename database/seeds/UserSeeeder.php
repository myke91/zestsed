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
                    'name' => 'kweku one',
                    'username' => 'fred',
                    'email' => 'fred@one.com',
                    'password' => 'pass123'
        ]);
    }

}
