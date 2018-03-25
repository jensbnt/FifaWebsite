<?php

namespace App\Http\Controllers;

use App\Team;
use App\TeamPlayer;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function getTeamsIndex() {
        $teams = Team::all();
        return view('teams.index', ['teams' => $teams]);
    }

    public function postTeamsAdd(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:2'
        ]);

        $team = new Team([
            'name' => $request->input('name')
        ]);
        $team->save();

        return redirect()->route('teams.index')->with('info', 'Team created: ' . $request->input('name'));
    }

    public function postTeamsDelete(Request $request) {
        $team = Team::find($request->input('teamid'));

        if(!isset($team))
            return view('pages.error', ['message' => "No team with id: " . $request->input('teamid')]);

        TeamPlayer::where('team_id', $team->id)->delete();
        $team->delete();

        return redirect()->route('teams.index')->with('info', 'Team deleted: ' . $team->name);
    }

    public function postTeamPlayerDelete(Request $request) {
        $teamPlayer = TeamPlayer::find($request->input('teamplayerid'));

        if(!isset($teamPlayer))
            return view('pages.error', ['message' => "No teamplayer with id: " . $request->input('teamplayerid')]);

        $teamPlayer->delete();

        return redirect()->route('teams.index')->with('info', 'Player deleted from team');
    }

    public function getTeamsView($id) {
        $team = Team::find($id);

        if(!isset($team))
            return view('pages.error', ['message' => "No team with id: " . $id]);

        return view('teams.view', ['team' => $team]);
    }
}
