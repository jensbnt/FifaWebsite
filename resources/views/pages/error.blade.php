@extends('layouts.master')

@section('content')
    <div class="thread">
        <div class="header">
            <i class="material-icons">highlight_off</i>
            <h1>Error</h1>
        </div>
        @if(isset($message))
            <p>Error: {{ $message }}</p>
        @else
            <p>Error</p>
        @endif
    </div>
@endsection