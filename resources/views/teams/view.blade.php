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
                <form action="{{ route('teams.view', ['id' => $team->id]) }}" method="get">
                    {{ csrf_field() }}

                    <div class="row form-group">
                        <div class="col-md-11">
                            <select id="sort" class="form-control" name="sort">
                                <option value="0" selected></option>
                                <option value="1">Games</option>
                                <option value="2">Goals</option>
                                <option value="3">Assists</option>
                            </select>

                            @if ($errors->has('sort'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sort') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-dark">
                                Sort
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
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
                            <td><a href="{{ route('teams.playerview', ['id' => $teamplayer->id]) }}">{{ $teamplayer->player->name }}</a></td>
                            <td>{{ $teamplayer->player->rating }}</td>
                            <td>{{ $teamplayer->player->position }}</td>
                            <td>{{ $teamplayer->player->cardtype }}</td>
                            <td>{{ $teamplayer->games }}</td>
                            <td>{{ $teamplayer->goals }}</td>
                            <td>{{ $teamplayer->assists }}</td>
                            <td>
                                @if($teamplayer->contributions() < 0.5)
                                    <span style="color: #ff0000;">{{ $teamplayer->contributions() }}</span>
                                @elseif($teamplayer->contributions() < 1)
                                    <span style="color: #ffa500;">{{ $teamplayer->contributions() }}</span>
                                @else
                                    <span style="color: #2ca02c;">{{ $teamplayer->contributions() }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <h3 class="card-header">Add/Remove games</h3>
                    <div class="card-body">
                        <form action="{{ route('teams.view', ['id' => $team->id]) }}" method="post">
                            {{ csrf_field() }}

                            <div class="row form-group">
                                <div class="col-md-8">
                                    <input id="games" type="number" class="form-control" name="games" value="{{ old('games') == "" ? 0 : old('games') }}">

                                    @if ($errors->has('games'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('games') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-dark">
                                        Edit games
                                    </button>
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
                        <form action="{{ route('teams.view', ['id' => $team->id]) }}" method="post">
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