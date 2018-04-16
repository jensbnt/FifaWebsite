<?php

use Illuminate\Database\Seeder;

class TeamPlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Barcelona Default */
        for($i = 1; $i < 12; $i++) {
            $teamplayer = new App\TeamPlayer([
                'player_id' => $i * 100,
                'team_id' => 1,
                'games' => rand(30, 40),
                'goals' => rand(1, 20),
                'assists' => rand(1, 20)
            ]);
            $teamplayer->save();
        }

        /* Real Madrid Default */
        for($i = 12; $i < 23; $i++) {
            $teamplayer = new App\TeamPlayer([
                'player_id' => $i * 100,
                'team_id' => 2,
                'games' => rand(30, 40),
                'goals' => rand(1, 20),
                'assists' => rand(1, 20)
            ]);
            $teamplayer->save();
        }
    }
}
