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
                <h1>Stats</h1>
                <p>This is the 'stats' page. Stats currently include the top players and an overview of clubs and nations. More stats will be added soon...</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3 text-center">
                    <div class="card-header text-muted">
                        Stats
                    </div>
                    <img class="rounded mx-auto d-block mt-4" src="https://futhead.cursecdn.com/static/img/18/players_alt/p50519998.png" style="width: 40%;">
                    <div class="card-body">
                        <h1>Top players</h1>
                        <p>This page contains the best global players.</p>
                        <a href="{{ route('stats.top') }}" class="btn btn-primary">Visit stats</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-3 text-center">
                    <div class="card-header text-muted">
                        Stats
                    </div>
                    <img class="rounded mx-auto d-block mt-4" src="https://futhead.cursecdn.com/static/img/18/nations/7.png" style="width: 40%;">
                    <div class="card-body">
                        <h1>Nations</h1>
                        <p>This page contains all nations.</p>
                        <a href="" class="btn btn-primary">Visit stats</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-3 text-center">
                    <div class="card-header text-muted">
                        Stats
                    </div>
                    <img class="rounded mx-auto d-block mt-4" src="https://futhead.cursecdn.com/static/img/18/clubs/241.png" style="width: 40%;">
                    <div class="card-body text-center">
                        <h1>Clubs</h1>
                        <p>This page contains all clubs.</p>
                        <a href="" class="btn btn-primary">Visit stats</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

