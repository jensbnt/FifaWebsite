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

        $players = Player::where('name', 'LIKE', $term)->orderBy('rating', 'desc')->paginate(30);
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
}
