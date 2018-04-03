<?php

use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = new App\Team([
            'name' => "Barcelona",
            'description' => 'Leuk team met allemaal goede spelers.'
        ]);
        $team->save();

        $team = new App\Team([
            'name' => "Real Madrid",
            'description' => 'Vet team. Heeft ook de beste speler ter wereld. <3'
        ]);
        $team->save();
    }
}
