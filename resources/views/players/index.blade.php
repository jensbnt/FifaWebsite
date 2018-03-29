@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Filter players</h1>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" method="GET" action="{{ route('players.index') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-dark">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <table class="table table-striped table-hover">
                    <caption>All players ({{ $count }} results)</caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 10%">ID</th>
                        <th scope="col" style="width: 60%">Name</th>
                        <th scope="col" style="width: 10%">Rating</th>
                        <th scope="col" style="width: 10%">Position</th>
                        <th scope="col" style="width: 10%">Cardtype</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($players as $player)
                        <tr>
                            <th scope="row">{{ $player->id }}</th>
                            <td><a href="{{ route('players.view', ['id' => $player->id]) }}">{{ $player->name }}</a></td>
                            <td>{{ $player->rating }}</td>
                            <td>{{ $player->position }}</td>
                            <td>{{ $player->cardtype }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $players->links() }}
            </div>
        </div>
    </div>
@endsection