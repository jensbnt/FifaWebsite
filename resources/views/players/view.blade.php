@extends('layouts.master')

@section('content')
    @if(Session::has('info'))
        <div class="message">
            <i class="material-icons">feedback</i>
            <p>{{ Session::get('info') }}</p>
        </div>
    @endif
    <div class="thread">
        <div class="header">
            <i class="material-icons">person</i>
            <h1>{{ $player->name }}</h1>
        </div>
        <p>Rating: {{ $player->rating }}</p>
        <p>Position: {{ $player->position }}</p>
        <p>Type: {{ $player->cardtype }}</p>
        <p>Current teams:
            @foreach($player->teamPlayers as $teamPlayer)
                <a href="{{ route('teams.view', $teamPlayer->team->id) }}">{{ $teamPlayer->team->name }}</a>
            @endforeach
        </p>
    </div>
    <div class="thread">
        <div class="header">
            <i class="material-icons">person</i>
            <h1>Add to team</h1>
        </div>
        <form action="{{ route('players.view', ['id' => $player->id]) }}" method="post">
            <select name="teamid">
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
            {{ csrf_field() }}
            <button type="submit" class="submitBtn">Add to team</button>
        </form>
    </div>
@endsection