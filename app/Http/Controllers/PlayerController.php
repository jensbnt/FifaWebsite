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
        $paginate = 30;
        $term = "%" . $request->input('name') . "%";

        $players = Player::where('name', 'LIKE', $term)
            ->where('position', 'LIKE', "%" . $request->input('position'))
            ->where('cardtype', 'LIKE', "%" . $request->input('type') . "%")
            ->orderBy('rating', 'desc')
            ->paginate($paginate);

        $count = Player::where('name', 'LIKE', $term)->count();

        $positions = Player::select('position')->groupBy('position')->get();
        $types = Player::select('cardtype')->groupBy('cardtype')->get();

        return view('players.index', ['players' => $players->appends($request->except('page')), 'positions' => $positions, 'types' => $types, 'count' => $count, 'paginate' => $paginate, 'fname' => $request->input('name'), "fposition" => $request->input('position'), "ftype" => $request->input('type')]);
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

    public function getPlayersAddFile() {
        return view('players.addfile');
    }

    public function postPlayersAddFile(Request $request) {
        return redirect()->route('players.index')->with('fail', "Adding players with .csv currently disabled");

        $this->validate($request, [
            'file' => 'required'
        ]);

        $file = $request->file('file');

        if(!$file->isValid())
            return view('pages.error', ['message' => "File error"]);

        $errors = 0;
        $playercount = 0;

        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if(count($data) != 7) {
                    $errors++;
                } elseif(!is_numeric($data[1])) {
                    $errors++;
                } elseif(filter_var($data[4], FILTER_VALIDATE_URL) === false) {
                    $errors++;
                } elseif(filter_var($data[5], FILTER_VALIDATE_URL) === false) {
                    $errors++;
                } elseif(filter_var($data[6], FILTER_VALIDATE_URL) === false) {
                    $errors++;
                } elseif(getimagesize($data[4]) === false) {
                    $errors++;
                } elseif(getimagesize($data[5]) === false) {
                    $errors++;
                } elseif(getimagesize($data[6]) === false) {
                    $errors++;
                } else {
                    $playercount++;
                    $player = new Player([
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'name' => $data[0],
                        'rating' => $data[1],
                        'position' => $data[2],
                        'cardtype' => $data[3],
                        'club_img_link' => $data[4],
                        'nation_img_link' => $data[5],
                        'player_img_link' => $data[6],
                    ]);
                    $player->save();
                }
            }
            fclose($handle);
        }

        return redirect()->route('players.index')->with('info', $playercount . ' players added with ' . $errors . " errors.");
    }

    public function getPlayersEdit($id) {
        $player = Player::find($id);

        if(!isset($player))
            return view('pages.error', ['message' => "No player with id: " . $id]);

        $positions = Player::select('position')->groupBy('position')->get();
        $cardtypes = Player::select('cardtype')->groupBy('cardtype')->get();

        return view('players.edit', ['player' => $player, 'positions' => $positions, 'cardtypes' => $cardtypes]);
    }

    public function postPlayersEdit($id, Request $request) {
        $player = Player::find($id);

        if(!isset($player))
            return view('pages.error', ['message' => "No player with id: " . $id]);

        $this->validate($request, [
            'name' => 'required|min:2',
            'rating' => 'required|numeric|min:0|max:99',
            'position' => 'required',
            'cardtype' => 'required',
            'player_img_link' => 'required|active_url',
        ]);


        $player->name =  $request->input('name');
        $player->rating =  $request->input('rating');
        $player->position = $request->input('position');
        $player->cardtype = $request->input('cardtype');
        $player->player_img_link = $request->input('player_img_link');
        $player->save();

        return redirect()->route('players.view', ['id' => $player->id])->with('info', 'Player updated: "' . $player->name . '"');
    }

    public function postPlayersDelete($id) {
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

        return view('players.top', ['players' => $players->appends($request->except('page')), 'sort' => $request->input('sort'), 'paginate' => $paginate]);
    }
}
