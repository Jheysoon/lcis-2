@if(Session::has('message'))
    {!! Session::get('message') !!}
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        {!! htmlAlert($error) !!}
    @endforeach
@endif