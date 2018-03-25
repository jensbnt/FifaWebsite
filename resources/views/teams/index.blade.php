@extends('layouts.master')

@section('content')
    @if(Session::has('info'))
        <div class="message">
            <i class="material-icons">feedback</i>
            <p>{{ Session::get('info') }}</p>
        </div>
    @endif
    <div class="thread">
        <div class="header">
            <i class="material-icons">person</i>
            <h1>Teams</h1>
        </div>
        @foreach($teams as $team)
            <p><a href="{{ route('teams.view', $team->id) }}">{{ $team->name }}</a></p>
        @endforeach
    </div>
    <div class="thread">
        <div class="header">
            <i class="material-icons">person</i>
            <h1>Options</h1>
        </div>
        <h2>Add team</h2>
        <form action="{{ route('teams.add') }}" method="post">
            <input type="text" name="name" placeholder="Team name">
            {{ csrf_field() }}
            <button type="submit" class="submitBtn">Add team</button>
            @include('partials.errors')
        </form>
        <h2>Delete team</h2>
        <form action="{{ route('teams.delete') }}" method="post">
            <select name="teamid">
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
            {{ csrf_field() }}
            <button type="submit" class="submitBtn">Delete team</button>
            @include('partials.errors')
        </form>
    </div>
@endsection