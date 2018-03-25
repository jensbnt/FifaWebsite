<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamPlayer extends Model
{
    protected $fillable = ['player_id', 'team_id', 'goals', 'assists', 'games'];

    public function contributions() {
        if($this->games != 0) {
            return round(($this->goals + $this->assists) / $this->games, 3);
        } else {
            return 0;
        }
    }

    public function player() {
        return $this->belongsTo('\App\Player', 'player_id', 'id');
    }

    public function team() {
        return $this->belongsTo('\App\Team', 'team_id', 'id');
    }
}
