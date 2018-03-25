@extends('layouts.master')

@section('content')
    <div class="thread">
        <div class="header">
            <i class="material-icons">person</i>
            <h1>Filter</h1>
        </div>
        <form action="{{ route('players.index') }}" method="get">
            <input type="text" name="name" placeholder="Name" value="{{ isset($name) ? $name : "" }}">
            <button type="submit" class="submitBtn">Filter</button>
            @include('partials.errors')
        </form>
    </div>
    <div class="tablethread">
        <div class="header">
            <i class="material-icons">person</i>
            <h1>All players ({{ $count }} results)</h1>
        </div>
        <table class='dbtable'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Rating</th>
                <th>Position</th>
                <th>Cardtype</th>
            </tr>
            @foreach($players as $player)
                <tr>
                    <td>{{ $player->id }}</td>
                    <td><a href="{{ route('players.view', ['id' => $player->id]) }}">{{ $player->name }}</a></td>
                    <td>{{ $player->rating }}</td>
                    <td>{{ $player->position }}</td>
                    <td>{{ $player->cardtype }}</td>
                </tr>
            @endforeach
        </table>
        {{ $players->links() }}
    </div>
@endsection