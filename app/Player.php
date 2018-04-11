<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name', 'rating', 'position', 'cardtype', 'seeded'];

    public function teamPlayers() {
        return $this->hasMany('\App\TeamPlayer', 'player_id', 'id');
    }

    public function games() {
        $total = 0;
        foreach ($this->teamPlayers as $teamplayer) {
            $total += $teamplayer->games;
        }
        return $total;
    }

    public function goals() {
        $total = 0;
        foreach ($this->teamPlayers as $teamplayer) {
            $total += $teamplayer->goals;
        }
        return $total;
    }

    public function assists() {
        $total = 0;
        foreach ($this->teamPlayers as $teamplayer) {
            $total += $teamplayer->assists;
        }
        return $total;
    }

    public function contributions() {
        $total = 0;
        $count = 0;
        foreach ($this->teamPlayers as $teamplayer) {
            $total += $teamplayer->contributions();
            $count++;
        }


        return $count == 0 ? 0 : round($total / $count, 3);
    }
}
