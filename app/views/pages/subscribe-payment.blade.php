@section('title', 'Become a member')

@section('content')

  <div class="subscribe">


    @if(!Auth::getUser()->is_member)
      <div class="paypal-container">
        
        <p>Become a member today to access some of our best images! What you get:</p>
        <ul class="list-unstyled">
          <li>Unlimited access to our members images</li>
          <li>High res downloads of your favourite species</li>
        </ul>
        <br>
        <p>And all for a one off fee of </p>
        <h2>Only £10</h2>
        <br>


        <button id="paypal-button" class="btn btn--secondary"></button>
        <input type="hidden" id="client_token" value="{{ $client_token }}" readonly disabled>
      </div>
    @else
      <p>Looks like your already a member</p>
    @endif

  </div>

@stop

@section('scripts')

  @if(!Auth::getUser()->is_member)
    <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4 log-level="warn"></script>
  @endif

  @parent

@stop