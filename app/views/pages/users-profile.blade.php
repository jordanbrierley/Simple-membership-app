@section('title', 'Update your profile')

@section('content')

    {{ Form::open(array('url' => 'account/profile',  'method' => 'post')) }}

      <div class="fieldset">

        <div class="form-group">
          <label for="exampleInputEmail1">Username</label>
          <input type="text" name="username" id="exampleInputEmail1" placeholder="Enter Username" value="{{ $user->username }}" readonly disabled>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value=" {{ $user->email }}" readonly disabled>
        </div>      

        <div class="form-group">
          <label for="first_name">Username</label>
          <input type="text" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ $user->first_name }}" >
        </div>

        <div class="form-group">
          <label for="surname">Username</label>
          <input type="text" name="surname" id="surname" placeholder="Enter Surname" value="{{ $user->surname }}" >
        </div>       
        
        <button type="submit" class="btn btn--primary">Submit</button>
      </div>
    {{ Form::close() }}

    @if(count($user->transactions) > 0)
      <div class="transactions">      
        <h2>Transactions</h2>
        @foreach($user->transactions as $transaction)
          <div class="transaction__row">
            <p>Payment of £{{ $transaction->amount }} was {{ $transaction->status }} on {{ $transaction->created_at->format('jS M, \'y ') }} </p>
          </div>
        @endforeach
      </div>
    @endif
@stop