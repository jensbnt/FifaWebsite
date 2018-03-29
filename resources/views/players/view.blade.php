@extends('layouts.master')

@section('content')
    <div class="container">
        @if(Session::has('info'))
            <div class="alert alert-dark" role="alert">
                {{ Session::get('info') }}
            </div>
        @endif
        @include('partials.errors')
        <div class="row">
            <div class="col-md">
                <h1>{{ $player->name }}</h1>
                <p>Rating: {{ $player->rating }}</p>
                <p>Position: {{ $player->position }}</p>
                <p>Type: {{ $player->cardtype }}</p>
                <p>Current teams:
                    @foreach($player->teamPlayers as $teamPlayer)
                        <a href="{{ route('teams.view', $teamPlayer->team->id) }}">{{ $teamPlayer->team->name }}</a>
                    @endforeach
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <h1>Add to team</h1>
                <form action="{{ route('players.view', ['id' => $player->id]) }}" method="post">
                    <div class="form-group">
                        <select class="form-control" name="teamid">
                            <option selected>-</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-dark">Add to team</button>
                </form>
            </div>
        </div>
    </div>
@endsection