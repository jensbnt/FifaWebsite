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
        for($i = 0; $i < 20; $i++) {
            $teamplayer = new App\TeamPlayer([
                'player_id' => rand($i * 10 + 1, $i * 10 + 10),
                'team_id' => 1,
                'games' => rand(30, 40),
                'goals' => rand(5, 20),
                'assists' => rand(1, 20)
            ]);
            $teamplayer->save();
        }

        /* Real Madrid Default */
        for($i = 20; $i < 40; $i++) {
            $teamplayer = new App\TeamPlayer([
                'player_id' => rand($i * 10 + 1, $i * 10 + 10),
                'team_id' => 2,
                'games' => rand(30, 40),
                'goals' => rand(5, 20),
                'assists' => rand(1, 20)
            ]);
            $teamplayer->save();
        }
    }
}
