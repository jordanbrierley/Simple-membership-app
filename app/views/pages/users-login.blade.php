
@section('title', 'Login')

@section('content')

    {{ Form::open(array('url' => 'users/login',  'method' => 'post')) }}
      <div class="fieldset">
        <div class="form-group">
          <label for="username">Username</label>
          {{ $errors->first('username') }}
          <input type="text" name="username" id="username" placeholder="Enter Username" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          {{ $errors->first('password') }}
          <input type="password" name="password" id="password" placeholder="Password" required>
        </div>

        <div class="form-group">
          <label for="remember"><input type="checkbox" name="remember" id="remember"> remember me</label>
        </div>

        <div class="button-group">
          <button type="submit" class="btn btn--primary">Submit</button>
        </div>
      </div>
    {{ Form::close() }}
@stop