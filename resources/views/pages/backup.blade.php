@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1 mb-3 text-center">
                <h1>Backups</h1>
                <p>Here you can make backups of your players, teams and teamp players. Backups are stored on your server as a json, located at <code>~/public/json</code>. Loading a backup make take some time. Do <b>NOT</b> reload the page while the backup is still in progress.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 offset-md-1">
                <div class="card mb-3">
                    <div class="card-header text-center">
                        <span class="text-muted">Backup</span>
                    </div>
                    <div class="card-body text-center">
                        <h1>Players</h1>
                        <p>This sections handles the players. This backup saves all players and their personal information. This update generally takes the longest, as there are over 4000 players.</p>
                        <div class="row">
                            <form class="col-md-6" method="POST" action="{{ route('backup.index') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="player-make" value="">
                                <button type="submit" class="btn btn-primary btn-block" {{ $playersempty ? "disabled" : "" }}>Make</button>
                            </form>
                            <form class="col-md-6" method="POST" action="{{ route('backup.index') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="player-load" value="">
                                <button type="submit" class="btn btn-success btn-block">Load</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-header text-center">
                        <span class="text-muted">Backup</span>
                    </div>
                    <div class="card-body text-center">
                        <h1>Teams & Team players</h1>
                        <p>This section handles the teams and the teamplayers. This backup saves all teams and their players. This includes player stats (games, goals and assists) and team information.</p>
                        <div class="row">
                            <form class="col-md-6" method="POST" action="{{ route('backup.index') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="team-make" value="">
                                <button type="submit" class="btn btn-primary btn-block" {{ $teamsempty ? "disabled" : "" }}>Make</button>
                            </form>
                            <form class="col-md-6" method="POST" action="{{ route('backup.index') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="team-load" value="">
                                <button type="submit" class="btn btn-success btn-block">Load</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

