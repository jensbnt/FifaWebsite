@extends('layouts.master')

@section('content')
    <div class="tablethread">
        <div class="header">
            <i class="material-icons">person</i>
            <h1>{{ $team->name }}</h1>
        </div>
        <table class='dbtable'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Rating</th>
                <th>Position</th>
                <th>Type</th>
                <th>Games</th>
                <th>G</th>
                <th>A</th>
                <th>C</th>
            </tr>
            @foreach($team->teamPlayers as $teamplayer)
                <tr>
                    <td>{{ $teamplayer->player->id }}</td>
                    <td><a href="{{ route('players.view', ['id' => $teamplayer->player->id]) }}">{{ $teamplayer->player->name }}</a></td>
                    <td>{{ $teamplayer->player->rating }}</td>
                    <td>{{ $teamplayer->player->position }}</td>
                    <td>{{ $teamplayer->player->cardtype }}</td>
                    <td>{{ $teamplayer->games }}</td>
                    <td>{{ $teamplayer->goals }}</td>
                    <td>{{ $teamplayer->assists }}</td>
                    <td>{{ $teamplayer->contributions() }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="thread">
        <div class="header">
            <i class="material-icons">person</i>
            <h1>Options</h1>
        </div>
        <h2>Delete player</h2>
        <form action="{{ route('teams.playerdelete') }}" method="post">
            <select name="teamplayerid">
                @foreach($team->teamPlayers as $teamplayer)
                    <option value="{{ $teamplayer->id }}">{{ $teamplayer->player->id }} - {{ $teamplayer->player->name }}</option>
                @endforeach
            </select>
            {{ csrf_field() }}
            <button type="submit" class="submitBtn">Delete player</button>
            @include('partials.errors')
        </form>
    </div>
@endsection