@if(Session::has('info'))
    <div class="alert alert-dark" role="alert">
        {{ Session::get('info') }}
    </div>
@elseif(Session::has('fail'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('fail') }}
    </div>
@endif