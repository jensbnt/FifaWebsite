<nav class="navbar navbar-fixed-top navbar-expand-md navbar-dark bg-dark" role="navigation">
    <a class="navbar-brand" href="{{ route('pages.index') }}">FifaApp</a>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            @if(Auth::check())
                <li class="nav-item"><a class="nav-link" href="{{ route('players.index') }}">Players</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('teams.index') }}">Teams</a></li>
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