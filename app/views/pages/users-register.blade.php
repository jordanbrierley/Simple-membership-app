@section('title', 'Register')

@section('content')

    {{ Form::open(array('url' => 'users/register',  'method' => 'post')) }}
      <div class="fieldset">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" placeholder="Enter Username" required>
        </div>

        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
        </div>
        
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="Password" required>
        </div>
        <div class="button-group">
          <button type="submit" class="btn btn--primary">Submit</button>
        </div>
      </div>
    {{ Form::close() }}
@stop