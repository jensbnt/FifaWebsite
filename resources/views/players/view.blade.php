@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 offset-md-1">
                <div class="card mb-3">
                    <div class="card-body">
                        <h2>{{ $player->name }}</h2>
                        <p>Rating: {{ $player->rating }}</p>
                        <p>Position: {{ $player->position }}</p>
                        <p>Type: {{ $player->cardtype }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="" data-toggle="modal" data-target="#confirm-delete">Delete player</a>
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
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <h3>Add to team</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('players.view', ['id' => $player->id]) }}">
                            {{ csrf_field() }}

                            <div class="row form-group">
                                <div class="col-md-8">
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

                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-dark">
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

    <!-- CONFIRMATION DIALOG -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Warning!</h2>
                </div>
                <div class="modal-body">
                    Do you really want to delete {{ $player->name }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="{{ route('players.delete', ['id' => $player->id]) }}" class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection