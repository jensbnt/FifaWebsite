@if(count($errors->all()) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endforeach
@endif