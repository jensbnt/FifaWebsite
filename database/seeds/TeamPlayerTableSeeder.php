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
        $teamplayer = new App\TeamPlayer([
            'player_id' => 46,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 64,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 244,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 245,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 246,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 307,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 311,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 747,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 772,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 1139,
            'team_id' => 1
        ]);
        $teamplayer->save();

        /* Real Madrid Default */
        $teamplayer = new App\TeamPlayer([
            'player_id' => 32,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 132,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 134,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 169,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 170,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 308,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 326,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 411,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 505,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([
            'player_id' => 1205,
            'team_id' => 2
        ]);
        $teamplayer->save();
    }
}
