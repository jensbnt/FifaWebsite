<?php

namespace App\Http\Controllers;

use App\Club;
use App\Nation;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function getStatsIndex() {
        return view('stats.index');
    }

    public function getStatsTop(Request $request) {
        $this->validate($request, [
            'sort' => 'numeric|min:1|max:4'
        ]);

        $paginate = 30;

        if(!$request->has('sort') || $request->input('sort') == "1") {
            $players = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('games', 'desc')
                ->orderBy('ctr', 'desc')
                ->paginate($paginate);
        } else if ($request->input('sort') == "2") {
            $players = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('goals', 'desc')
                ->orderBy('ctr', 'desc')
                ->paginate($paginate);
        } else if ($request->input('sort') == "3") {
            $players = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('assists', 'desc')
                ->orderBy('ctr', 'desc')
                ->paginate($paginate);
        } else if ($request->input('sort') == "4") {
            $players = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 10)
                ->orderBy('ctr', 'desc')
                ->orderBy('games', 'desc')
                ->paginate($paginate);
        }

        return view('stats.top', ['players' => $players->appends($request->except('page')), 'sort' => $request->input('sort'), 'paginate' => $paginate]);
    }

    public function getStatsNations() {
        //$nations = Player::select('nation_img_link')->groupBy('nation_img_link')->get();
        $nations = Nation::all();

        return view('stats.nations', ['nations' => $nations]);
    }

    public function getStatsClubs() {
        //$clubs = Player::select('club_img_link')->groupBy('club_img_link')->get();
        $clubs = Club::all();

        return view('stats.clubs', ['clubs' => $clubs]);
    }
}
