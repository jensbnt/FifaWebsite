<?php

namespace App\Http\Controllers;

use App\Player;
use App\Team;
use App\TeamPlayer;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    function getBackupIndex() {
        $playersempty = count(Player::all()) == 0;
        $teamsempty = count(Team::all()) == 0;

        return view('pages.backup', ['playersempty' => $playersempty, 'teamsempty' => $teamsempty]);
    }

    function postBackupIndex(Request $request) {
        if($request->has('player-make')) {
            return $this->playerMakeBackup();
        } else if($request->has('player-load')) {
            return $this->playerLoadBackup();
        } else if($request->has('team-make')) {
            return $this->teamMakeBackup();
        } else if($request->has('team-load')) {
            return $this->teamLoadBackup();
        } else {
            return redirect()->route('backup.index')->with('info', 'Error');
        }
    }

    function playerMakeBackup() {
        $file = public_path().'/json/player-backup.json';
        $players = Player::all();
        file_put_contents($file, json_encode($players));

        return redirect()->route('backup.index')->with('info', 'Made backup of players');
    }

    function playerLoadBackup() {
        $file = public_path().'/json/player-backup.json';
        if(!file_exists($file)) {
            return redirect()->route('backup.index')->with('info', 'No backup file found for: "players"');
        }
        Player::truncate();

        $json = json_decode(file_get_contents($file));
        foreach ($json as $item) {
            $player = new Player([
                'id' => $item->id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'seeded' => $item->seeded,
                'name' => $item->name,
                'rating' => $item->rating,
                'position' => $item->position,
                'cardtype' => $item->cardtype,
                'club_img_link' => $item->club_img_link,
                'nation_img_link' => $item->nation_img_link,
                'player_img_link' => $item->player_img_link,
            ]);
            $player->save();
        }

        return redirect()->route('backup.index')->with('info', 'Loaded backup of players');
    }

    function teamMakeBackup() {
        /* Teams */
        $file = public_path().'/json/team-backup.json';
        $teams = Team::all();
        file_put_contents($file, json_encode($teams));

        /* Team players */
        $file = public_path().'/json/teamplayer-backup.json';
        $teamplayers = TeamPlayer::all();
        file_put_contents($file, json_encode($teamplayers));

        return redirect()->route('backup.index')->with('info', 'Made backup of teams and team players');
    }

    function teamLoadBackup() {
        /* Teams */
        $file = public_path().'/json/team-backup.json';
        if(!file_exists($file)) {
            return redirect()->route('backup.index')->with('info', 'No backup file found for: "teams"');
        }
        Team::truncate();

        $json = json_decode(file_get_contents($file));
        foreach ($json as $item) {
            $team = new Team([
                'id' => $item->id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'name' => $item->name,
                'description' => $item->description,
                'formation' => $item->formation,
                'club_img_link' => $item->club_img_link,
            ]);
            $team->save();
        }

        /* Team players */
        $file = public_path().'/json/teamplayer-backup.json';
        if(!file_exists($file)) {
            return redirect()->route('backup.index')->with('info', 'No backup file found for: "team players"');
        }
        TeamPlayer::truncate();

        $json = json_decode(file_get_contents($file));
        foreach ($json as $item) {
            $teamplayer = new TeamPlayer([
                'id' => $item->id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'player_id' => $item->player_id,
                'team_id' => $item->team_id,
                'goals' => $item->goals,
                'assists' => $item->assists,
                'games' => $item->games,
            ]);
            $teamplayer->save();
        }

        return redirect()->route('backup.index')->with('info', 'Loaded backup of teams and team players');
    }
}
