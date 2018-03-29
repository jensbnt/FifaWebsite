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
        $this->call(UserTableSeeder::class);
        $this->call(PlayerTableSeeder::class);
        $this->call(TeamTableSeeder::class);
        $this->call(TeamPlayerTableSeeder::class);
    }
}
