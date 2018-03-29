@extends('layouts.master')

@section('content')
    <div class="container">
        @if(Session::has('info'))
            <div class="alert alert-dark" role="alert">
                {{ Session::get('info') }}
            </div>
        @endif
        @include('partials.errors')
        <div class="row">
            <div class="col-md">
                <h1>Teams</h1>
                @foreach($teams as $team)
                    <p><a href="{{ route('teams.view', $team->id) }}">{{ $team->name }}</a></p>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <h1>Add team</h1>
                <form action="{{ route('teams.add') }}" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Team name">
                    </div>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-dark">Add team</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <h1>Delete team</h1>
                <form action="{{ route('teams.delete') }}" method="post">
                    <div class="form-group">
                        <select class="form-control" name="teamid">
                            <option selected>-</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-dark">Delete team</button>
                </form>
            </div>
        </div>
    </div>
@endsection