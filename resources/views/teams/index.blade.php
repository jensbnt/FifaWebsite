@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            @foreach($teams as $team)
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $team->name }}</h5>
                            <p>{{ strlen($team->description) > 60 ? substr($team->description, 0, 60) . " ..." : $team->description }}</p>
                            <a href="{{ route('teams.view', ['id' => $team->id]) }}" class="btn btn-dark">Visit team</a>
                        </div>
                        <div class="card-footer text-muted">
                            <a href="{{ route('teams.edit', ['id' => $team->id]) }}">Edit - Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection