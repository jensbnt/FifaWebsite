@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <form action="" method="get">
                    {{ csrf_field() }}

                    <div class="row form-group">
                        <div class="col-md-11">
                            <select id="sort" class="form-control" name="sort">
                                <option value="1" {{ (!isset($sort) || $sort == "1" ? "selected" : "") }}>Games</option>
                                <option value="2" {{ (isset($sort) && $sort == "2" ? "selected" : "") }}>Goals</option>
                                <option value="3" {{ (isset($sort) && $sort == "3" ? "selected" : "") }}>Assists</option>
                                <option value="4" {{ (isset($sort) && $sort == "4" ? "selected" : "") }}>Contributions</option>
                            </select>

                            @if ($errors->has('sort'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sort') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-dark">
                                Sort
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 10%">#</th>
                        <th scope="col" style="width: 40%">Name</th>
                        <th scope="col" style="width: 5%">Rating</th>
                        <th scope="col" style="width: 10%">Position</th>
                        <th scope="col" style="width: 10%">Type</th>
                        <th scope="col" style="width: 5%">Games</th>
                        <th scope="col" style="width: 5%">Goals</th>
                        <th scope="col" style="width: 5%">Assists</th>
                        <th scope="col" style="width: 10%">Contributions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < count($players); $i++)
                        <tr>
                            <th scope="row">{{ ($players->currentPage() - 1) * $paginate  + $i + 1 }}</th>
                            <td><a href="{{ route('players.view', ['id' => $players[$i]->id]) }}">{{ $players[$i]->name }}</a></td>
                            <td>{{ $players[$i]->rating }}</td>
                            <td>{{ $players[$i]->position }}</td>
                            <td>{{ $players[$i]->cardtype }}</td>
                            <td>{{ $players[$i]->games }}</td>
                            <td>{{ $players[$i]->goals }}</td>
                            <td>{{ $players[$i]->assists }}</td>
                            <td>
                                @if($players[$i]->ctr < 0.5)
                                    <span style="color: #ff0000;">{{ $players[$i]->ctr }}</span>
                                @elseif($players[$i]->ctr < 1)
                                    <span style="color: #ffa500;">{{ $players[$i]->ctr }}</span>
                                @else
                                    <span style="color: #2ca02c;">{{ $players[$i]->ctr }}</span>
                                @endif
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
                {{ $players->links() }}
            </div>
        </div>
    </div>
@endsection