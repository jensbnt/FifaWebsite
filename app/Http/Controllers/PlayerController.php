<?php

namespace App\Http\Controllers;

use App\Player;
use App\Team;
use App\TeamPlayer;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function getPlayersIndex(Request $request) {
        $name = $request->has('name') ? $request->input('name') : "";
        $term = "%" . $name . "%";

        $players = Player::where('name', 'LIKE', $term)->paginate(30);
        $count = Player::where('name', 'LIKE', $term)->count();

        return view('players.index', ['players' => $players->appends($request->except('page')), 'count' => $count, 'name' => $name]);
    }

    public function getPlayersView($id) {
        $player = Player::find($id);

        if(!isset($player))
            return view('pages.error', ['message' => "No player with id: " . $id]);

        $teams = Team::all();

        return view('players.view', ['player' => $player, 'teams' => $teams]);
    }

    public function postPlayersView($id, Request $request) {
        $this->validate($request, [
            'teamid' => 'required'
        ]);

        $player = Player::find($id);

        if(!isset($player))
            return view('pages.error', ['message' => "No player with id: " . $id]);

        $team = Team::find($request->input('teamid'));

        if(!isset($team))
            return view('pages.error', ['message' => "No team with id: " . $request->input('teamid')]);

        $existingPlayer = TeamPlayer::where([
            ['player_id', $id],
            ['team_id', $request->input('teamid')]
        ])->first();

        if (isset($existingPlayer))
            return redirect()->route('players.view', ['id' => $id])->with('info', 'Player already in this team');

        $teamplayer = new TeamPlayer([
            'player_id' => $id,
            'team_id' => $request->input('teamid')
        ]);
        $teamplayer->save();

        return redirect()->route('players.view', ['id' => $id])->with('info', 'Player added');
    }
}
