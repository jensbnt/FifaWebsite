<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name'];

    public function teamPlayers() {
        return $this->hasMany('\App\TeamPlayer', 'team_id', 'id');
    }
}
