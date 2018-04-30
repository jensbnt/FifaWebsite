<?php

namespace App\Http\Controllers;

use App\Club;
use App\Nation;
use App\Player;
use App\Team;
use App\TeamPlayer;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    function getBackupIndex() {
        $playersempty = count(Player::all()) == 0;
        $teamsempty = count(Team::all()) == 0;
        $configallowed = count(Nation::all()) == 0 && count(Club::all()) == 0;

        return view('pages.backup', ['playersempty' => $playersempty, 'teamsempty' => $teamsempty, 'configallowed' => $configallowed]);
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
        } else if($request->has('config')) {
            return $this->configureNationCLub();
        } else {
            return redirect()->route('backup.index')->with('info', 'Error');
        }
    }

    function playerMakeBackup() {
        $file = public_path().'/json/player-backup.json';
        $players = Player::all();
        file_put_contents($file, json_encode($players));

        /*$file = public_path().'/json/nation-backup.json';
        $nations = Nation::all();
        file_put_contents($file, json_encode($nations));

        $file = public_path().'/json/clubs-backup.json';
        $clubs = Club::all();
        file_put_contents($file, json_encode($clubs));*/

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

    function configureNationCLub() {
        Nation::truncate();
        Club::truncate();

        $nations = Player::select('nation_img_link')
            ->where('nation_img_link', '<>', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/No_sign.svg/450px-No_sign.svg.png')
            ->groupBy('nation_img_link')->get();
        foreach ($nations as $nation) {
            $entry = new Nation([
                'name' => 'Nation',
                'nation_img_link' => $nation->nation_img_link,
            ]);
            $entry->save();
        }

        $clubs = Player::select('club_img_link')
            ->where('club_img_link', '<>', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/No_sign.svg/450px-No_sign.svg.png')
            ->groupBy('club_img_link')->get();
        foreach ($clubs as $club) {
            $entry = new Club([
                'name' => 'Club',
                'club_img_link' => $club->club_img_link,
            ]);
            $entry->save();
        }

        $players = Player::all();
        foreach ($players as $player) {
            $nation = Nation::where('nation_img_link', $player->nation_img_link)->first();
            $club = Club::where('club_img_link', $player->club_img_link)->first();

            if(isset($nation)) {
                $player->nation_id = $nation->id;
                $player->nation_img_link = "";
            }
            if(isset($club)) {
                $player->club_id = $club->id;
                $player->club_img_link = "";
            }
            $player->save();
        }

        return redirect()->route('backup.index')->with('info', 'Config succesfull');
    }
}
