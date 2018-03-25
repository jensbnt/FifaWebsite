@extends('layouts.master')

@section('content')
    <div class="thread">
        <div class="header">
            <i class="material-icons">mail_outline</i>
            <h1>Welcome</h1>
        </div>
        <p>Jelle can't work with laravel or lavander.</p>
        <h2>Sections</h2>
        <p><a href="{{ route('players.index') }}">Players</a></p>
        <p><a href="{{ route('teams.index') }}">Teams</a></p>
    </div>
@endsection