<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['id', 'name', 'description', 'formation', 'club_img_link'];

    public function teamPlayers() {
        return $this->hasMany('\App\TeamPlayer', 'team_id', 'id');
    }
}
