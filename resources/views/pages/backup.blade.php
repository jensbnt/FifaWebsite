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
            <div class="col-md-6 offset-md-3">
                <div class="card mb-3">
                    <div class="card-header text-center">
                        <span class="text-muted">Backup</span>
                    </div>
                    <div class="card-body text-center">
                        <h1>Global backup</h1>
                        <p>---MESSAGE---</p>
                        <div class="row">
                            <form class="col-md-5 offset-md-1" method="POST" action="{{ route('backup.index') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="make" value="">
                                <button type="submit" class="btn btn-primary btn-block" {{ $backupdisabled ? "disabled" : "" }}>Make</button>
                            </form>
                            <form class="col-md-5" method="POST" action="{{ route('backup.index') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="load" value="">
                                <button type="submit" class="btn btn-success btn-block">Load</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

