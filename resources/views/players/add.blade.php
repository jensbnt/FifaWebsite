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
                        <h1>Add player</h1>
                        <p>Add a player to the database. You can edit this player and it's pictures later. All fields are required.</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('players.add') }}">
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
                                <label for="rating" class="col-md-2 offset-md-1 control-label">Rating</label>

                                <div class="col-md-8">
                                    <input id="rating" type="number" class="form-control" name="rating" value="{{ old('rating') }}">

                                    @if ($errors->has('rating'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rating') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="position" class="col-md-2 offset-md-1 control-label">Position</label>

                                <div class="col-md-8">
                                    <select id="position" class="form-control" name="position">
                                        <option {{ old('position') == "" ? "selected" : "" }}></option>
                                        @foreach($positions as $position)
                                            <option value="{{ $position->position }}" {{ old('position') == $position->position ? "selected" : "" }}>{{ $position->position }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('position'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('position') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="cardtype" class="col-md-2 offset-md-1 control-label">Cardtype</label>

                                <div class="col-md-8">
                                    <select id="cardtype"  class="form-control" name="cardtype">
                                        <option {{ old('position') == "" ? "selected" : "" }}></option>
                                        @foreach($cardtypes as $cardtype)
                                            <option value="{{ $cardtype->cardtype }}" {{ old('cardtype') == $cardtype->cardtype ? "selected" : "" }}>{{ $cardtype->cardtype }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('cardtype'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cardtype') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-4 offset-md-3">
                                    <button type="submit" class="btn btn-dark btn-block">
                                        Add player
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