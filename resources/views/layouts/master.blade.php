<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ URL::to('css/main-style.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Fifa</title>
</head>
<body>
@include('partials.header')
@yield('content')
</body>
<footer>
    <p>Jens heeft dit gemaakt.</p>
    <p>Jelle bakt er niks van :(</p>
</footer>
</html>
