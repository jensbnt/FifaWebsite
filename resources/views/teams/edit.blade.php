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
                        <h1>Edit team</h1>
                        <p>Here you can edit or remove this team. Removing it will also remove all this teams's players. All fields are required.</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('teams.edit', ['id' => $team->id]) }}">
                            {{ csrf_field() }}

                            <div class="row form-group">
                                <label for="name" class="col-md-2 offset-md-1 control-label">Name</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') == "" ? $team->name : old('name') }}" autofocus>

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
                                    <textarea id="description" type="text" class="form-control" name="description" rows="3" style="resize: none;">{{ old('description') == "" ? $team->description : old('description') }}</textarea>

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
                                    <input id="formation" type="text" class="form-control" name="formation" value="{{ old('formation') == "" ? $team->formation : old('formation') }}">

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
                                        Save team
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-danger btn-block" href="" data-toggle="modal" data-target="#confirm-delete">Delete</a>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('teams.view', ['id' => $team->id]) }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CONFIRMATION DIALOG -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Warning!</h2>
                </div>
                <div class="modal-body">
                    Do you really want to delete {{ $team->name }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('teams.delete', ['id' => $team->id]) }}">
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-ok">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection