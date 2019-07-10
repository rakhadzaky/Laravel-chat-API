<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(PersonsTableSeeder::class);
        $this->call(ChatsTableSeeder::class);
    }
}
