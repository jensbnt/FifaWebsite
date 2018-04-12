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
                <form class="form-horizontal" method="GET" action="{{ route('players.index') }}">
                    {{ csrf_field() }}

                    <div class="row form-group">
                        <div class="col-md-11">
                            <input id="name" type="text" class="form-control" name="name" placeholder="name" value="{{ old('name') != "" ? old('name') : $name }}">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-dark">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <table class="table table-striped table-hover">
                    <caption>Players - {{ $count }} results</caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 10%">ID</th>
                        <th scope="col" style="width: 5%"></th>
                        <th scope="col" style="width: 5%"></th>
                        <th scope="col" style="width: 45%">Name</th>
                        <th scope="col" style="width: 10%">Rating</th>
                        <th scope="col" style="width: 10%">Position</th>
                        <th scope="col" style="width: 15%">Cardtype</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($players as $player)
                        <tr>
                            <th scope="row">{{ $player->id }}</th>
                            <td><img style="width: 30px;" src="{{ $player->nation_img_link }}" alt="Card image cap"></td>
                            <td><img style="width: 30px;" src="{{ $player->club_img_link }}" alt="Card image cap"></td>
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