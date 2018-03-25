<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = new App\Team([
            'name' => "Barcelona"
        ]);
        $team->save();

        $team = new App\Team([
            'name' => "Real Madrid"
        ]);
        $team->save();
    }
}
