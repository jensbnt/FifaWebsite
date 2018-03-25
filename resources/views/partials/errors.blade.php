@if(count($errors->all()) > 0)
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif