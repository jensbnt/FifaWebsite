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
        $this->call(TeamSeeder::class);
        $this->call(TeamPlayerSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
