@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1>Add players (.csv)</h1>
                        <p>Add a bunch of players to the database. You can edit these players and their pictures later. The format of these players should be:</p>
                        <p><b>NAME | RATING | POSITION | TYPE | PLAYER_IMG | NATION_ID | CLUB_ID</b></p>
                    </div>
                    <div class="card-body">
                        {{ Form::open(array('url' => route('players.addfile'), 'files' => true)) }}
                        {{ csrf_field() }}

                        <div class="row form-group">
                            <label for="file" class="col-md-3 control-label">Player file (.csv)</label>

                            <div class="col-md-8">
                                {{ Form::file('file') }}

                                @if ($errors->has('file'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4 offset-md-3">
                                <button type="submit" class="btn btn-dark btn-block">
                                    Add players
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('players.index') }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection