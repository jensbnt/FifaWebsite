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
                        <h1>Edit player</h1>
                        <p>Here you can edit or remove this player. Removing it will also remove all stats in any team. All fields are required.</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('players.edit', ['id' => $player->id]) }}">
                            {{ csrf_field() }}

                            @if($player->seeded != 1)
                                <div class="row form-group">
                                    <label for="name" class="col-md-2 offset-md-1 control-label">Name</label>

                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') == "" ? $player->name : old('name') }}" autofocus>

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
                                        <input id="rating" type="number" class="form-control" name="rating" value="{{ old('rating') == "" ? $player->rating : old('rating') }}">

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
                                                <option value="{{ $position->position }}" {{ old('position') == $position->position || $player->position == $position->position ? "selected" : "" }}>{{ $position->position }}</option>
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
                                                <option value="{{ $cardtype->cardtype }}" {{ old('cardtype') == $cardtype->cardtype || $player->cardtype == $cardtype->cardtype ? "selected" : "" }}>{{ $cardtype->cardtype }}</option>
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
                                    <label for="player_img_link" class="col-md-2 offset-md-1 control-label">Player image</label>

                                    <div class="col-md-8">
                                        <input id="player_img_link" type="text" class="form-control" name="player_img_link" value="{{ old('player_img_link') == "" ? $player->player_img_link : old('player_img_link') }}">

                                        @if ($errors->has('player_img_link'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('player_img_link') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label for="nation_img_link" class="col-md-2 offset-md-1 control-label">Nation image</label>

                                    <div class="col-md-8">
                                        <input id="nation_img_link" type="text" class="form-control" name="nation_img_link" value="{{ old('nation_img_link') == "" ? $player->nation_img_link : old('nation_img_link') }}">

                                        @if ($errors->has('nation_img_link'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nation_img_link') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label for="club_img_link" class="col-md-2 offset-md-1 control-label">Club image</label>

                                    <div class="col-md-8">
                                        <input id="club_img_link" type="text" class="form-control" name="club_img_link" value="{{ old('club_img_link') == "" ? $player->club_img_link : old('club_img_link') }}">

                                        @if ($errors->has('club_img_link'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('club_img_link') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-3 offset-md-3">
                                        <button type="submit" class="btn btn-dark">
                                            Update player
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <a class="btn btn-danger" href="" data-toggle="modal" data-target="#confirm-delete">Delete</a>
                                    </div>
                                </div>
                            @else
                                You can't edit this player
                            @endif
                        </form>
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
                    Do you really want to delete {{ $player->name }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="{{ route('players.delete', ['id' => $player->id]) }}" class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection