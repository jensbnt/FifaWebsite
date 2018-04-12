@extends('layouts.master')

@section('content')
    <div class="container">
        @if(!Auth::check())
            <div class="row">
                <div class="col-md">
                    <h1>Welcome</h1>
                    <p>It seems you are not logged in!</p>
                    <p><a href="{{ route('auth.signin') }}">Login</a></p>
                    <p><a href="{{ route('auth.register') }}">Register</a></p>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md">
                    <h1>Welcome</h1>
                    <p>Jelle can't work with laravel or lavander.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <h1>Sections</h1>
                    <p><a href="{{ route('players.index') }}">Players</a></p>
                    <p><a href="{{ route('teams.index') }}">Teams</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <h1>To Do</h1>
                    <p>Nations and club db</p>
                    <p>Player sort</p>
                    <p>User binded teams & teamplayers</p>
                    <p>Admin sections & accounts</p>
                </div>
            </div>
        @endif
    </div>
@endsection

