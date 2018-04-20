<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['id', 'seeded', 'name', 'rating', 'position', 'cardtype', 'player_img_link', 'club_img_link', 'nation_img_link'];

    public function teamPlayers() {
        return $this->hasMany('\App\TeamPlayer', 'player_id', 'id');
    }
}
