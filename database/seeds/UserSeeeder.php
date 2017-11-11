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
        User::insert(
                [
                    [
                        'name' => 'kweku one',
                        'email' => 'kweku@one.com',
                        'password' => bcrypt('pass123')
                    ]
        ]);
    }

}
