<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        $this->call(App\UserSeeeder::class);
=======
        // $this->call(UsersTableSeeder::class);
        factory(App\Registration::class, 100)->create();
        factory(App\Contribution::class, 100)->create();
        factory(App\Investment::class, 200)->create();

>>>>>>> 5e46b170fd076f69529943a6bb928b7b96b6a2dc
    }
}
