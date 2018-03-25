<div class="navigation">
    <nav>
        <ul>
            <li><a href="{{ route('pages.index') }}"><i class="material-icons">home</i></a></li>
            <li><a href="{{ route('players.index') }}">Players</a></li>
            <li><a href="{{ route('teams.index') }}">Teams</a></li>
            <li class="right"><a href="">Log out</a></li>
            <li class="right"><a href=""><i class="material-icons">account_circle</i></a></li>
            <li class="right"><a href=""><i class="material-icons">mail_outline</i></a></li>
            <li class="right">
                <form action="" method="get">
                    <input type="text" class="searchbar" placeholder="Search" name="Zoekterm">
                </form>
            </li>
        </ul>
    </nav>
</div>