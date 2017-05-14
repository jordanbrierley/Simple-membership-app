@section('title', 'Subscribe')

@section('content')

  @if(!Auth::getUser()->is_member)

    <button id="paypal-button" class="btn btn--secondary">Pay With Paypal</button>

    <div hidden id="client_token" data-clientToken="{{ $client_token }}">{{ $client_token }}</div>

  @else
    
    Looks like your already a member

  @endif

@stop


@section('scripts')

  @parent

  @if(!Auth::getUser()->is_member)
  <!-- Load the required components. -->
  
  <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4 log-level="warn"></script>
  <script src="https://js.braintreegateway.com/web/3.14.0/js/client.min.js"></script>
  <script src="https://js.braintreegateway.com/web/3.14.0/js/paypal-checkout.min.js"></script>
  <!-- <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script> -->

  <script>
    // Create a client.
      var clientToken = document.querySelector('#client_token').innerText;

      braintree.client.create({
        authorization: clientToken
      }, function (clientErr, clientInstance) {

        // Stop if there was a problem creating the client.
        // This could happen if there is a network error or if the authorization
        // is invalid.
        if (clientErr) {
          console.error('Error creating client:', clientErr);
          return;
        }

        // Create a PayPal Checkout component.
        braintree.paypalCheckout.create({
          client: clientInstance
        }, function (paypalCheckoutErr, paypalCheckoutInstance) {

          // Stop if there was a problem creating PayPal Checkout.
          // This could happen if there was a network error or if it's incorrectly
          // configured.
          if (paypalCheckoutErr) {
            console.error('Error creating PayPal Checkout:', paypalCheckoutErr);
            return;
          }

          // Set up PayPal with the checkout.js library
          paypal.Button.render({
            env: 'sandbox', // or 'sandbox'

            payment: function () {
              return paypalCheckoutInstance.createPayment({
                flow: 'checkout', // Required
                amount: '10.00', // Required
                currency: 'GBP', // Required
                locale: 'en_GB',
                enableShippingAddress: false,
                // shippingAddressEditable: false,
                // shippingAddressOverride: {
                //   recipientName: 'Jordan Brierley',
                //   line1: '1234 Main St.',
                //   line2: 'Unit 1',
                //   city: 'Newcastle',
                //   countryCode: 'GB',
                //   postalCode: 'NE28 6JY',
                //   phone: '01234567890'
                // }
              });


            },

            onAuthorize: function (data, actions) {
              // console.log('payment successful', data);

                // return paypal.request.post('/account/upgrade', {
                //       payToken: data.paymentID,
                //       payerId: data.payerID
                //   }).then(function (res) {
                //       document.querySelector('.display-3').innerText = 'Payment Complete!';
                //   });

              return paypalCheckoutInstance.tokenizePayment(data)
                .then(function (payload) {
                    console.log(payload);
                  // Submit `payload.nonce` to your server
                   return paypal.request.post('/account/upgrade/', {
                        payment_method_nonce: payload.nonce
                    })
                    .then(function (response) {
                        console.log('Payment Controller Response', response);
                        document.querySelector('.display-3').innerText = 'Payment Complete!';
                    });
                });
            },

            onCancel: function (data) {
              console.log('checkout.js payment cancelled', JSON.stringify(data, 0, 2));
            },

            onError: function (err) {
              console.error('checkout.js error', err);
            }
          }, '#paypal-button').then(function () {
            // The PayPal button will be rendered in an html element with the id
            // `paypal-button`. This function will be called when the PayPal button
            // is set up and ready to be used.
          });

        });

      });


  </script>

  @endif


@stop