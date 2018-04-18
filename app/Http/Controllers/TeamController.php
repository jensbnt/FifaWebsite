<?php

namespace App\Http\Controllers;

use App\Player;
use App\Team;
use App\TeamPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    /* INDEX */

    public function getTeamsIndex() {
        $teams = Team::all();
        return view('teams.index', ['teams' => $teams]);
    }

    /* TEAM VIEW */

    public function getTeamsView($id, Request $request) {
        $this->validate($request, [
            'sort' => 'numeric|min:1|max:4'
        ]);

        $team = Team::find($id);

        if(!isset($team))
            return view('pages.error', ['message' => "No team with id: " . $id]);

        $paginate = 15;

        if(!$request->has('sort') || $request->input('sort') == "1") {
            $players = TeamPlayer::join('players', 'team_players.player_id', '=', 'players.id')
                ->select('players.*', 'team_players.id as team_player_id', 'team_players.games', 'team_players.goals', 'team_players.assists', DB::raw("ROUND((team_players.goals + team_players.assists) / team_players.games, 3) as ctr"))
                ->where('team_id', '=', $id)
                ->orderBy('games', 'desc')
                ->orderBy('ctr', 'desc')
                ->paginate($paginate);
        } else if ($request->input('sort') == "2") {
            $players = TeamPlayer::join('players', 'team_players.player_id', '=', 'players.id')
                ->select('players.*', 'team_players.id as team_player_id', 'team_players.games', 'team_players.goals', 'team_players.assists', DB::raw("ROUND((team_players.goals + team_players.assists) / team_players.games, 3) as ctr"))
                ->where('team_id', '=', $id)
                ->orderBy('goals', 'desc')
                ->orderBy('ctr', 'desc')
                ->paginate($paginate);
        } else if ($request->input('sort') == "3") {
            $players = TeamPlayer::join('players', 'team_players.player_id', '=', 'players.id')
                ->select('players.*', 'team_players.id as team_player_id', 'team_players.games', 'team_players.goals', 'team_players.assists', DB::raw("ROUND((team_players.goals + team_players.assists) / team_players.games, 3) as ctr"))
                ->where('team_id', '=', $id)
                ->orderBy('assists', 'desc')
                ->orderBy('ctr', 'desc')
                ->paginate($paginate);
        } else if ($request->input('sort') == "4") {
            $players = TeamPlayer::join('players', 'team_players.player_id', '=', 'players.id')
                ->select('players.*', 'team_players.id as team_player_id', 'team_players.games', 'team_players.goals', 'team_players.assists', DB::raw("ROUND((team_players.goals + team_players.assists) / team_players.games, 3) as ctr"))
                ->where('team_id', '=', $id)
                ->orderBy('ctr', 'desc')
                ->orderBy('games', 'desc')
                ->paginate($paginate);
        }

        return view('teams.view', ['team' => $team, 'players' => $players->appends($request->except('page')), 'sort' => $request->input('sort')]);
    }

    public function postTeamsView($id, Request $request) {
        $team = Team::find($id);

        if(!isset($team))
            return view('pages.error', ['message' => "No team with id: " . $id]);

        if($request->has('games')) {
            return $this->teamGameEdit($id, $request);
        } else {
            return $this->teamPlayerDelete($request);
        }
    }

    public function teamGameEdit($id, Request $request) {
        $this->validate($request, [
            'games' => 'required|numeric'
        ]);

        $team = Team::find($id);

        foreach ($team->teamPlayers as $teamPlayer) {
            $teamPlayer->games += $request->input('games');
            $teamPlayer->save();
        }

        return redirect()->route('teams.view', ['id' => $team->id])->with('info', "Games updated");
    }

    public function teamPlayerDelete(Request $request) {
        $this->validate($request, [
            'teamplayerid' => 'required'
        ]);

        $teamPlayer = TeamPlayer::find($request->input('teamplayerid'));

        if(!isset($teamPlayer))
            return view('pages.error', ['message' => "No teamplayer with id: " . $request->input('teamplayerid')]);

        $id = $teamPlayer->team_id;

        $teamPlayer->delete();

        return redirect()->route('teams.view', ['id' => $id])->with('info', '"' . $teamPlayer->player->name . '" deleted from team');
    }

    /* ADD */

    public function getTeamsAdd() {
        return view('teams.add');
    }

    public function postTeamsAdd(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:2',
            'description' => 'min:2'
        ]);

        $team = new Team([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        $team->save();

        return redirect()->route('teams.index')->with('info', 'Team created: ' . $team->name);
    }

    /* EDIT */

    public function getTeamsEdit($id) {
        $team = Team::find($id);

        if(!isset($team))
            return view('pages.error', ['message' => "No team with id: " . $id]);

        return view('teams.edit', ['team' => $team]);
    }

    public function postTeamsEdit($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|min:2',
            'description' => 'min:2'
        ]);

        $team = Team::find($id);

        if(!isset($team))
            return view('pages.error', ['message' => "No team with id: " . $id]);

        $team->name = $request->input('name');
        $team->description = $request->input('description');
        $team->save();

        return redirect()->route('teams.index')->with('info', 'Team updated: ' . $team->name);
    }

    /* DELETE */

    public function getTeamsDelete($id) {
        $team = Team::find($id);

        if(!isset($team))
            return view('pages.error', ['message' => "No team with id: " . $id]);

        TeamPlayer::where('team_id', $team->id)->delete();
        $team->delete();

        return redirect()->route('teams.index')->with('info', 'Team deleted: ' . $team->name);
    }

    /* TEAMPLAYER */

    public function postTeamPlayerAdd($id, Request $request) {
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
            return redirect()->route('players.view', ['id' => $id])->with('info', '"' . $player->name . '" is already in this team');

        $teamplayer = new TeamPlayer([
            'player_id' => $id,
            'team_id' => $request->input('teamid')
        ]);
        $teamplayer->save();

        return redirect()->route('players.view', ['id' => $id])->with('info', '"' . $player->name . '" added to ' . $team->name);
    }

    /* TEAMPLAYER VIEW */

    public function getTeamsPlayerView($id) {
        $teamplayer = TeamPlayer::find($id);

        if(!isset($teamplayer))
            return view('pages.error', ['message' => "No teamplayer with id: " . $id]);

        return view('teams.playerview', ['teamplayer' => $teamplayer]);
    }

    public function postTeamsPlayerView($id, Request $request) {
        $this->validate($request, [
            'games' => 'required|numeric|min:0',
            'goals' => 'required|numeric|min:0',
            'assists' => 'required|numeric|min:0'
        ]);

        $teamplayer = TeamPlayer::find($id);

        if(!isset($teamplayer))
            return view('pages.error', ['message' => "No teamplayer with id: " . $id]);

        $teamplayer->games = $request->input('games');
        $teamplayer->goals = $request->input('goals');
        $teamplayer->assists = $request->input('assists');
        $teamplayer->save();

        return redirect()->route('teams.view', ['id' => $teamplayer->team_id])->with('info', $teamplayer->player->name . "'s stats edited");
    }

    /* ADD GAME */

    public function getTeamsAddGame($id) {
        $team = Team::find($id);

        if(!isset($team))
            return view('pages.error', ['message' => "No team with id: " . $id]);

        return view('teams.addgame', ['team' => $team]);
    }

    public function postTeamsAddGame($id, Request $request) {
        $team = Team::find($id);

        if(!isset($team))
            return view('pages.error', ['message' => "No team with id: " . $id]);
        foreach ($team->teamPlayers as $teamPlayer) {
            $save = false;

            if($request->input($teamPlayer->id)['goals'] != null) {
                $teamPlayer->goals += $request->input($teamPlayer->id)['goals'];
                $save = true;
            }

            if($request->input($teamPlayer->id)['assists'] != null) {
                $teamPlayer->assists += $request->input($teamPlayer->id)['assists'];
                $save = true;
            }

            if($save) {
                $teamPlayer->games += 1;
                $teamPlayer->save();
            }
        }

        return redirect()->route('teams.view', ['id' => $id]);
    }
}
