<nav class="navbar navbar-fixed-top navbar-expand-md navbar-dark bg-dark" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('pages.index') }}">FifaApp</a>
    </div>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            @if(Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Players
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('players.index') }}">All</a>
                        <a class="dropdown-item" href="{{ route('players.add') }}">Add player</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Teams
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('teams.index') }}">All</a>
                        <a class="dropdown-item" href="{{ route('teams.add') }}">Add team</a>
                    </div>
                </li>
            @endif
        </ul>
        <ul class="nav navbar-nav ml-auto">
            @if(!Auth::check())
                <li class="nav-item"><a class="nav-link" href="{{ route('auth.signin') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('auth.register') }}">Register</a></li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
        </ul>
    </div>
</nav>