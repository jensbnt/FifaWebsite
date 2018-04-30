<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['id', 'seeded', 'name', 'rating', 'position', 'cardtype', 'player_img_link', 'nation_id', 'club_id'];

    public function teamPlayers() {
        return $this->hasMany('\App\TeamPlayer', 'player_id', 'id');
    }

    public function nation() {
        return $this->belongsTo('\App\Nation', 'nation_id', 'id');
    }

    public function club() {
        return $this->belongsTo('\App\Club', 'club_id', 'id');
    }
}
