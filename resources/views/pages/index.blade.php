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
                    <div class="card mb-3">
                        <div class="card-body">
                            <h1>Welcome</h1>
                            <p>Jelle can't work with laravel or lavander.</p>
                            <p><a href="{{ route('players.index') }}">Players</a></p>
                            <p><a href="{{ route('teams.index') }}">Teams</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group mb-3">
                        <li class="list-group-item"><h1>Recent Updates</h1></li>
                        <li class="list-group-item"><b>v1.6</b> - Added player graphics (picture, club and nation)</li>
                        <li class="list-group-item"><b>v1.5</b> - Global player stats</li>
                        <li class="list-group-item"><b>v1.4</b> - Edit player's games, goals and assists</li>
                        <li class="list-group-item"><b>v1.3</b> - Add custom players</li>
                        <li class="list-group-item"><b>v1.2</b> - Add a team description and edit teams</li>
                        <li class="list-group-item"><b>v1.1</b> - User logins</li>
                        <li class="list-group-item"><b>v1.0</b> - Players, teams and team players</li>
                        <li class="list-group-item"><b>v0 and lower</b> - Design & testing</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group mb-3">
                        <li class="list-group-item"><h1>Future Updates</h1></li>
                        <li class="list-group-item">Nations and club database</li>
                        <li class="list-group-item">Player sort</li>
                        <li class="list-group-item">User owned teams and team players</li>
                        <li class="list-group-item">Admin sections and accounts</li>
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endsection

