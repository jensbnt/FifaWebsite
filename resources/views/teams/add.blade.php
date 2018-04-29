@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1>Add team</h1>
                        <p>This page lets you create your own teams and add players to it. You can edit this team later. All fields are required.</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('teams.add') }}">
                            {{ csrf_field() }}

                            <div class="row form-group">
                                <label for="name" class="col-md-2 offset-md-1 control-label">Name</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="description" class="col-md-2 offset-md-1 control-label">Description</label>

                                <div class="col-md-8">
                                    <textarea id="description" class="form-control" name="description" rows="3" style="resize: none;">{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="formation" class="col-md-2 offset-md-1 control-label">Formation</label>

                                <div class="col-md-8">
                                    <input id="formation" type="text" class="form-control" name="formation" value="{{ old('formation') }}">

                                    @if ($errors->has('formation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('formation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-4 offset-md-3">
                                    <button type="submit" class="btn btn-dark btn-block">
                                        Add team
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('teams.index') }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection