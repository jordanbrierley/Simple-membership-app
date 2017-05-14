@if($errors->has())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('status'))
    <div class="alert alert--error">
        {{ Session::get('status') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert--error">
        <div class="alert__close"></div>
        {{ Session::get('error') }}
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert--success">
        {{ Session::get('success') }}
    </div>
@endif