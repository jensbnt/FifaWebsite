<nav class="navbar navbar-fixed-top navbar-expand-md navbar-dark bg-dark" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('pages.index') }}">FifaApp</a>
    </div>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            @if(Auth::check())
                <li class="btn-group">
                    <a class="nav-link" href="{{ route('players.index') }}">Players</a>
                    <a class="nav-link dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('players.add') }}">Add player</a>
                        <a class="dropdown-item" href="{{ route('players.addfile') }}">Add players (.csv)</a>
                    </div>
                </li>

                <li class="btn-group">
                    <a class="nav-link" href="{{ route('teams.index') }}">Teams</a>
                    <a class="nav-link dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('teams.add') }}">Add team</a>
                    </div>
                </li>

                <li class="nav-item"><a class="nav-link" href="{{ route('players.top') }}">Top players</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('backup.index') }}">Backup</a></li>
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