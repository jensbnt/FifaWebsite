@extends('layouts.master')

@section('cdontent')
    <div class="tablethread">

        <table class='dbtable'>
            <tr>

            </tr>

        </table>
    </div>
    <div class="thread">
        <div class="header">
            <i class="material-icons">person</i>
            <h1>Options</h1>
        </div>
        <h2>Delete player</h2>

    </div>
@endsection

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
                <h1>{{ $team->name }}</h1>
                <p>Team page</p>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Position</th>
                    <th scope="col">Type</th>
                    <th scope="col">Games</th>
                    <th scope="col">G</th>
                    <th scope="col">A</th>
                    <th scope="col">C</th>
                </tr>
                </thead>
                <tbody>
                @foreach($team->teamPlayers as $teamplayer)
                    <tr>
                        <th scope="row">{{ $teamplayer->player->id }}</th>
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
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md">
                <h1>Delete player</h1>
                <form action="{{ route('teams.playerdelete') }}" method="post">
                    <div class="form-group">
                        <select class="form-control" name="teamplayerid">
                            <option selected>-</option>
                            @foreach($team->teamPlayers as $teamplayer)
                                <option value="{{ $teamplayer->id }}">{{ $teamplayer->player->id }} - {{ $teamplayer->player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-dark">Delete player</button>
                </form>
            </div>
        </div>
    </div>
@endsection