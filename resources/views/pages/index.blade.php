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
            <div class="row text-center align-items-center">
                <div class="col-md-2 mb-3">
                    <img src="https://lh3.googleusercontent.com/I3PdglBg645OuLJFv8_ZUOgAmgniL73KF9-V0Fxi8-_-eSN5KJed41GRwnlcmLnUbFc" alt="" class="card-img-top">
                </div>
                <div class="col-md-8 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="display-4">Welcome</h1>
                            <p class="lead">"Jelle can't work with laravel or lavander." - Jens Beernaert 2018</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <img src="https://s3.amazonaws.com/freebiesupply/large/2x/playstation-logo-png-transparent.png" alt="" class="card-img-top">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group mb-3">
                        <li class="list-group-item"><h1>Recent Updates</h1></li>
                        <li class="list-group-item"><b>v1.15</b> - Stats</li>
                        <li class="list-group-item"><b>v1.14</b> - Advanced sort</li>
                        <li class="list-group-item"><b>v1.13</b> - Team formations + pictures</li>
                        <li class="list-group-item"><b>v1.12</b> - Backups</li>
                        <li class="list-group-item"><b>v1.11</b> - Add players with .csv</li>
                        <li class="list-group-item"><b>v1.10</b> - Edit players</li>
                        <li class="list-group-item"><b>v1.9</b> - Add game option</li>
                        <li class="list-group-item"><b>v1.8</b> - Added top players</li>
                        <li class="list-group-item"><b>v1.7</b> - Added player sorting on team page</li>
                        <li class="list-group-item"><b>v1.6</b> - Added player graphics (picture, club and nation)</li>
                        <li class="list-group-item"><b>v1.5</b> - Global player stats</li>
                        <li class="list-group-item"><b>v1.4</b> - Edit player's games, goals and assists</li>
                        <li class="list-group-item"><b>v1.3</b> - Add custom players</li>
                        <li class="list-group-item"><b>v1.2</b> - Add a team description and edit teams</li>
                        <li class="list-group-item"><b>v1.1</b> - User logins</li>
                        <li class="list-group-item"><b>v1.0</b> - Players, teams and team players</li>
                        <li class="list-group-item"><b>v0</b> - Alpha build</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group mb-3">
                        <li class="list-group-item"><h1>Future Updates</h1></li>
                        <li class="list-group-item">Secure edit</li>
                        <li class="list-group-item">GK stats</li>
                        <li class="list-group-item">Custom team pictures</li>
                        <li class="list-group-item">Player match rating (x/10)</li>
                        <li class="list-group-item">Backup loading screen</li>
                        <li class="list-group-item">Position and type database</li>
                        <li class="list-group-item">Nations and club database</li>
                        <li class="list-group-item">User owned teams and team players</li>
                        <li class="list-group-item">Admin sections and accounts</li>
                        <li class="list-group-item">Trading manager</li>
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endsection

