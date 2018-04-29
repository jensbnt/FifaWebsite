@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1>{{ $teamplayer->player->name }} - stats</h1>
                        <p>This is the page that lets you edit a team player's stats. These stats only belong to this player's current team. All fields are required.</p>

                        <a href="{{ route('players.view', ['id' => $teamplayer->player->id]) }}">{{ $teamplayer->player->name }}</a> -
                        <a href="{{ route('teams.view', ['id' => $teamplayer->team->id]) }}">{{ $teamplayer->team->name }}</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route("teams.playerview", ['id' => $teamplayer->id]) }}">
                            {{ csrf_field() }}

                            <div class="row form-group">
                                <label for="games" class="col-md-2 offset-md-1 control-label">Games</label>

                                <div class="col-md-8">
                                    <input id="games" type="number" class="form-control" name="games" value="{{ old('games') == "" ? $teamplayer->games : old('games') }}" autofocus>

                                    @if ($errors->has('games'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('games') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="goals" class="col-md-2 offset-md-1 control-label">Goals</label>

                                <div class="col-md-8">
                                    <input id="goals" type="number" class="form-control" name="goals" value="{{ old('goals') == "" ? $teamplayer->goals : old('goals') }}" autofocus>

                                    @if ($errors->has('goals'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('goals') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="assists" class="col-md-2 offset-md-1 control-label">Assists</label>

                                <div class="col-md-8">
                                    <input id="assists" type="number" class="form-control" name="assists" value="{{ old('assists') == "" ? $teamplayer->assists : old('assists') }}" autofocus>

                                    @if ($errors->has('assists'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('assists') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-4 offset-md-3">
                                    <button type="submit" class="btn btn-dark btn-block">
                                        Update stats
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('teams.view', ['id' => $teamplayer->team->id]) }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection