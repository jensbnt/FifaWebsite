@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <h1>Add game</h1>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('teams.addgame', ['id' => $team->id]) }}">
                            {{ csrf_field() }}

                            @foreach($team->teamPlayers as $teamPlayer)
                                <div class="row form-group">
                                    <label class="col-md-2 offset-md-1 control-label">{{ $teamPlayer->player->name }}</label>

                                    <div class="col-md-4">
                                        <input placeholder="goals" type="text" class="form-control" name="{{ $teamPlayer->id }}[goals]" value="0">
                                    </div>

                                    <div class="col-md-4">
                                        <input placeholder="assists" type="text" class="form-control" name="{{ $teamPlayer->id }}[assists]" value="0">
                                    </div>
                                </div>
                            @endforeach

                            <div class="row form-group">
                                <div class="col-md-2 offset-md-3">
                                    <button type="submit" class="btn btn-dark">
                                        Save game
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