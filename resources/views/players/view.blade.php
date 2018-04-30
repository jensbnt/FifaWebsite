@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-body">
                        <h2>{{ $player->name }}</h2>
                        <p>Rating: {{ $player->rating }}</p>
                        <p>Position: {{ $player->position }}</p>
                        <p>Type: {{ $player->cardtype }}</p>
                        <hr>
                        <p>Total games: {{ $player->games }}</p>
                        <p>Total goals: {{ $player->goals }}</p>
                        <p>Total assists: {{ $player->assists }}</p>
                        <p>Total contributions:
                            @if($player->ctr < 0.5)
                                <span style="color: #ff0000;">{{ $player->ctr }}</span>
                            @elseif($player->ctr < 1)
                                <span style="color: #ffa500;">{{ $player->ctr }}</span>
                            @else
                                <span style="color: #2ca02c;">{{ $player->ctr }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        <span class="text-muted">
                            @if($player->seeded)
                                Seeded player
                            @else
                                Custom player
                            @endif
                        </span> -
                        <a href="{{ route('players.edit', ['id' => $player->id]) }}">Edit - Delete</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row">
                    <div class="col-md mb-3">
                        <img class="card-img-top" src="{{ $player->player_img_link }}" alt="Card image cap">
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        @if($player->nation != null)
                            <img class="card-img-top" src="{{ $player->nation->nation_img_link }}">
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if($player->club != null)
                            <img class="card-img-top" src="{{ $player->club->club_img_link }}">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <ul class="list-group mb-3">
                    <li class="list-group-item"><h2>Current teams</h2></li>
                    @if(count($player->teamPlayers) == 0)
                        <li class="list-group-item">-</li>
                    @endif
                    @foreach($player->teamPlayers as $teamPlayer)
                        <li class="list-group-item"><a href="{{ route('teams.view', $teamPlayer->team->id) }}">{{ $teamPlayer->team->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Add to team</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('players.view', ['id' => $player->id]) }}">
                            {{ csrf_field() }}

                            <div class="row form-group">
                                <div class="col-md-10">
                                    <select id="teamid" class="form-control" name="teamid">
                                        <option selected></option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('teamid'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('teamid') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-dark btn-block">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection