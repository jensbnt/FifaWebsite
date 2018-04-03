@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="card mb-3">
                    <div class="card-body">
                        <h2>{{ $team->name }}</h2>
                        <p>{{ $team->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
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
                    @foreach($teamplayers as $teamplayer)
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
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <h3 class="card-header">Manage stats</h3>
                    <div class="card-body">
                        <form action="" method="post">
                            {{ csrf_field() }}

                            <div class="row form-group">
                                <div class="col-md-8">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <h3 class="card-header">Delete player</h3>
                    <div class="card-body">
                        <form action="{{ route('teams.playerdelete') }}" method="post">
                            {{ csrf_field() }}

                            <div class="row form-group">
                                <div class="col-md-8">
                                    <select id="teamplayerid" class="form-control" name="teamplayerid">
                                        <option selected></option>
                                        @foreach($teamplayers as $teamplayer)
                                            <option value="{{ $teamplayer->id }}">{{ $teamplayer->player->id }} - {{ $teamplayer->player->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('teamplayerid'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('teamplayerid') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-dark">
                                        Delete player
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