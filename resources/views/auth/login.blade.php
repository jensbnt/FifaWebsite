@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row text-center align-items-center">
        <div class="col-md-2 mb-3">
            <img src="https://lh3.googleusercontent.com/I3PdglBg645OuLJFv8_ZUOgAmgniL73KF9-V0Fxi8-_-eSN5KJed41GRwnlcmLnUbFc" alt="" class="card-img-top">
        </div>
        <div class="col-md-8 mb-3">
            <h1 class="display-4">Welcome</h1>
            <p class="lead">"Jelle can't work with laravel or lavander." - Jens Beernaert 2018</p>
        </div>
        <div class="col-md-2 mb-3">
            <img src="https://s3.amazonaws.com/freebiesupply/large/2x/playstation-logo-png-transparent.png" alt="" class="card-img-top">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @include('partials.message')
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header text-center">
                    <b>Login</b>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('auth.signin') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md control-label">Username</label>

                            <div class="col-md">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md control-label">Password</label>

                            <div class="col-md">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-dark btn-block">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
