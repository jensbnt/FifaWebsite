<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::to('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Fifa</title>
</head>
<body>
@include('partials.header')
@yield('content')
</body>
<footer class="footer">
    <div class="container">
        <span class="text-muted">© 2018 Copyright: <a href="mailto:jens_beernaert@hotmail.com"> jens_beernaert@hotmail.com</a></span>
    </div>
</footer>
</html>
