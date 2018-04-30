@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            @foreach($nations as $nation)
                <div class="col-md-2">
                    <div class="card mb-3">
                        <div class="card-header text-center">
                            {{ $nation->name }}
                        </div>
                        <div class="card-body">
                            <img class="rounded mx-auto d-block" src="{{ $nation->nation_img_link }}" style="width: 100%;">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection