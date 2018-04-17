<?php

namespace App\Http\Controllers;

use App\Player;
use App\Team;
use App\TeamPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    public function getPlayersIndex(Request $request) {
        $name = $request->has('name') ? $request->input('name') : "";
        $term = "%" . $name . "%";

        $players = Player::where('name', 'LIKE', $term)->orderBy('id', 'asc')->paginate(30);
        $count = Player::where('name', 'LIKE', $term)->count();

        return view('players.index', ['players' => $players->appends($request->except('page')), 'count' => $count, 'name' => $name]);
    }

    public function getPlayersView($id) {
        $player = Player::leftJoin('team_players', 'players.id', '=', 'team_players.player_id')
            ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
            ->groupBy('players.id')
            ->where('players.id', '=', $id)
            ->first();

        if(!isset($player))
            return view('pages.error', ['message' => "No player with id: " . $id]);

        $teams = Team::all();

        return view('players.view', ['player' => $player, 'teams' => $teams]);
    }

    public function getPlayersAdd() {
        $positions = Player::select('position')->groupBy('position')->get();
        $cardtypes = Player::select('cardtype')->groupBy('cardtype')->get();

        return view('players.add', ['positions' => $positions, 'cardtypes' => $cardtypes]);
    }

    public function postPlayersAdd(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:2',
            'rating' => 'required|numeric|min:0|max:99',
            'position' => 'required',
            'cardtype' => 'required'
        ]);

        $player = new Player([
            'name' => $request->input('name'),
            'rating' => $request->input('rating'),
            'position' => $request->input('position'),
            'cardtype' => $request->input('cardtype'),
            'seeded' => false
        ]);
        $player->save();

        return redirect()->route('players.index')->with('info', 'Player added: "' . $player->name . '"');
    }

    public function getPlayersDelete($id) {
        $player = Player::find($id);

        if(!isset($player))
            return view('pages.error', ['message' => "No player with id: " . $id]);

        if($player->seeded)
            return redirect()->route('players.view', ['id' => $id])->with('fail', "You can't delete this player!");

        TeamPlayer::where('player_id', $player->id)->delete();
        $player->delete();

        return redirect()->route('players.index')->with('info', 'Player deleted: "' . $player->name . '"');
    }

    public function getPlayersTop(Request $request) {
        $this->validate($request, [
            'sort' => 'numeric|min:1|max:4'
        ]);

        if(!$request->has('sort') || $request->input('sort') == "1") {
            $players = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('games', 'desc')
                ->paginate(30);
        } else if ($request->input('sort') == "2") {
            $players = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('goals', 'desc')
                ->paginate(30);
        } else if ($request->input('sort') == "3") {
            $players = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('assists', 'desc')
                ->paginate(30);
        } else if ($request->input('sort') == "4") {
            $players = Player::join('team_players', 'players.id', '=', 'team_players.player_id')
                ->select('players.*', DB::raw("SUM(team_players.games) as games, SUM(team_players.goals) as goals, SUM(team_players.assists) as assists, ROUND((SUM(team_players.goals) + SUM(team_players.assists)) / SUM(team_players.games), 3) as ctr"))
                ->groupBy('players.id')
                ->where('games', '>', 0)
                ->orderBy('ctr', 'desc')
                ->paginate(30);
        }

        return view('players.top', ['players' => $players->appends($request->except('page')), 'sort' => $request->input('sort')]);
    }
}
