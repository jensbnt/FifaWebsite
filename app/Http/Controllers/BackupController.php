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
        $backupdisabled = count(Player::all()) == 0 || count(Team::all()) == 0 || count(Nation::all()) == 0 && count(Club::all()) == 0;
        $configallowed = count(Nation::all()) == 0 && count(Club::all()) == 0;

        return view('pages.backup', ['backupdisabled' => $backupdisabled, 'configallowed' => $configallowed]);
    }

    function postBackupIndex(Request $request) {
        if($request->has('make')) {
            return $this->makeBackup();
        } else if($request->has('load')) {
            return $this->loadBackup();
        } else {
            return redirect()->route('backup.index')->with('info', 'Error');
        }
    }

    function makeBackup() {
        /* Players */
        $file = public_path().'/json/player-backup.json';
        $players = Player::all();
        file_put_contents($file, json_encode($players));

        /* Teams */
        $file = public_path().'/json/team-backup.json';
        $teams = Team::all();
        file_put_contents($file, json_encode($teams));

        /* Team players */
        $file = public_path().'/json/teamplayer-backup.json';
        $teamplayers = TeamPlayer::all();
        file_put_contents($file, json_encode($teamplayers));

        /* Nations */
        $file = public_path().'/json/nation-backup.json';
        $nations = Nation::all();
        file_put_contents($file, json_encode($nations));

        /* Clubs */
        $file = public_path().'/json/club-backup.json';
        $clubs = Club::all();
        file_put_contents($file, json_encode($clubs));

        return redirect()->route('backup.index')->with('info', 'Backup complete');
    }

    function loadBackup() {
        $this->playerLoadBackup();
        $this->teamLoadBackup();
        $this->teamPlayerLoadBackup();
        $this->nationLoadBackup();
        $this->clubsLoadBackup();

        return redirect()->route('backup.index')->with('info', 'Loading complete');
    }

    function playerLoadBackup() {
        $file = public_path().'/json/player-backup.json';
        if(!file_exists($file)) {
            return false;
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
                'player_img_link' => $item->player_img_link,
                'nation_id' => $item->nation_id,
                'club_id' => $item->club_id,
            ]);
            $player->save();
        }
    }

    function teamLoadBackup() {
        $file = public_path().'/json/team-backup.json';
        if(!file_exists($file)) {
            return false;
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
    }

    function teamPlayerLoadBackup() {
        $file = public_path().'/json/teamplayer-backup.json';
        if(!file_exists($file)) {
            return false;
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
    }

    function nationLoadBackup() {
        $file = public_path().'/json/nation-backup.json';
        if(!file_exists($file)) {
            return false;
        }
        Nation::truncate();

        $json = json_decode(file_get_contents($file));
        foreach ($json as $item) {
            $nation = new Nation([
                'id' => $item->id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'name' => $item->name,
                'nation_img_link' => $item->nation_img_link,
            ]);
            $nation->save();
        }
    }

    function clubsLoadBackup() {
        $file = public_path().'/json/club-backup.json';
        if(!file_exists($file)) {
            return false;
        }
        Club::truncate();

        $json = json_decode(file_get_contents($file));
        foreach ($json as $item) {
            $club = new Club([
                'id' => $item->id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'name' => $item->name,
                'club_img_link' => $item->club_img_link,
            ]);
            $club->save();
        }
    }
}
