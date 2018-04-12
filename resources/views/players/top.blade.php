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
                <form action="" method="get">
                    {{ csrf_field() }}

                    <div class="row form-group">
                        <div class="col-md-11">
                            <select id="sort" class="form-control" name="sort">
                                <option value="1" {{ (!isset($sort) || $sort == "1" ? "selected" : "") }}>Games</option>
                                <option value="2" {{ (isset($sort) && $sort == "2" ? "selected" : "") }}>Goals</option>
                                <option value="3" {{ (isset($sort) && $sort == "3" ? "selected" : "") }}>Assists</option>
                                <option value="4" {{ (isset($sort) && $sort == "4" ? "selected" : "") }}>Contributions</option>
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
                        <th scope="col" style="width: 25%">Name</th>
                        <th scope="col" style="width: 10%">Rating</th>
                        <th scope="col" style="width: 10%">Position</th>
                        <th scope="col" style="width: 15%">Type</th>
                        <th scope="col" style="width: 10%">Games</th>
                        <th scope="col" style="width: 10%">Goals</th>
                        <th scope="col" style="width: 10%">Assists</th>
                        <th scope="col" style="width: 10%">Contributions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($players as $player)
                        <tr>
                            <td><a href="{{ route('players.view', ['id' => $player->id]) }}">{{ $player->name }}</a></td>
                            <td>{{ $player->rating }}</td>
                            <td>{{ $player->position }}</td>
                            <td>{{ $player->cardtype }}</td>
                            <td>{{ $player->games }}</td>
                            <td>{{ $player->goals }}</td>
                            <td>{{ $player->assists }}</td>
                            <td>
                                @if($player->ctr < 0.5)
                                    <span style="color: #ff0000;">{{ $player->ctr }}</span>
                                @elseif($player->ctr < 1)
                                    <span style="color: #ffa500;">{{ $player->ctr }}</span>
                                @else
                                    <span style="color: #2ca02c;">{{ $player->ctr }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection