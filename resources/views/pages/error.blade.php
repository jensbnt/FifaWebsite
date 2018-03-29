@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h1>Error Page</h1>
                @if(isset($message))
                    <p>Error: {{ $message }}</p>
                @else
                    <p>Error</p>
                @endif
            </div>
        </div>
    </div>
@endsection