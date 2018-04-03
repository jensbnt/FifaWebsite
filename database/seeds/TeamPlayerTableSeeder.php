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
        $teamplayer = new App\TeamPlayer([ // Messi
            'player_id' => 2,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Suarez
            'player_id' => 14,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Dembele
            'player_id' => 689,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Iniesta
            'player_id' => 140,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Busquets
            'player_id' => 258,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Coutinho
            'player_id' => 274,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Semodo
            'player_id' => 1179,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Umtiti
            'player_id' => 778,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Pique
            'player_id' => 320,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Alba
            'player_id' => 202,
            'team_id' => 1
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Ter stegen
            'player_id' => 1792,
            'team_id' => 1
        ]);
        $teamplayer->save();

        /* Real Madrid Default */
        $teamplayer = new App\TeamPlayer([ // Ronaldo
            'player_id' => 1,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Benezma
            'player_id' => 263,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Bale
            'player_id' => 67,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Modric
            'player_id' => 9,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Kroos
            'player_id' => 47,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Casemiro
            'player_id' => 204,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Marcelo
            'player_id' => 24,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Ramos
            'player_id' => 4,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Nacho
            'player_id' => 364,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Carvajal
            'player_id' => 551,
            'team_id' => 2
        ]);
        $teamplayer->save();

        $teamplayer = new App\TeamPlayer([ // Navas
            'player_id' => 1829,
            'team_id' => 2
        ]);
        $teamplayer->save();
    }
}
