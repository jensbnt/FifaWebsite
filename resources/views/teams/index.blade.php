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
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header text-center">
                            <b>{{ $team->formation }}</b>
                        </div>
                        <div class="text-center mt-3">
                            <img style="width: 20%;" src="{{ $team->club_img_link }}">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $team->name }}</h5>
                            <p>{{ strlen($team->description) > 60 ? substr($team->description, 0, 60) . " ..." : $team->description }}</p>
                            <a href="{{ route('teams.view', ['id' => $team->id]) }}" class="btn btn-primary">Visit team</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection