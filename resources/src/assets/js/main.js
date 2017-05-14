// set up a few variables
var totalRows = 3,
    itemCol = 0,
    containerClass = 'image-grid',
    columnClass = 'image-grid__column',
    itemClass = 'image-grid__item';

var imageGrid =  document.querySelector('.image-grid');
if (typeof(imageGrid) != 'undefined' && imageGrid !== null)
{
  // create the columns needed to add the images to
  for(var rowCount = 0; rowCount < totalRows; rowCount++){
    // create new column with class
    newCol = document.createElement('div');
    newCol.className = columnClass;
    // append new column to container
    document.getElementsByClassName(containerClass)[0].appendChild(newCol);
  }
  // loop through each item
  for(var itemCount = 0; itemCount < document.getElementsByClassName(itemClass).length; itemCount++){
    
    document.getElementsByClassName(columnClass)[itemCol].appendChild(document.getElementsByClassName(itemClass)[0]);
    
    if(itemCol < totalRows - 1){
      itemCol++; 
    } else {
      itemCol = 0;
    }

  }
}

// bing a event listener on the image list buttons and then  replace the contents of .member__image with the new image and download link
var imageLink =  document.querySelector('.image-list');
if (typeof(imageLink) != 'undefined' && imageLink !== null)
{
   document.querySelector(".image-list").addEventListener("click",function(e) {
      if(e.target && e.target.nodeName == "BUTTON") {
          image = document.createElement("img");
          image.src = e.target.dataset.link;
          var link = document.createElement("a");
          link.setAttribute('href', e.target.dataset.link + '/download');
          link.className = 'btn btn--primary';
          link.innerHTML = "Download image";

          var memberImage = document.querySelector(".member__image");
          if (memberImage.hasChildNodes()) {
            while (memberImage.hasChildNodes()) {
                memberImage.removeChild(memberImage.lastChild);
            }
          }
          memberImage.appendChild(image);
          memberImage.appendChild(link);
      }
  });
}


// set up paypal button

var paypalButton =  document.querySelector('#paypal-button');

if (typeof(paypalButton) != 'undefined' && paypalButton !== null)
{
  // hide the paypal button until it's ready to use
  paypalButton.style.display = 'none';

  require.config({
    paths: {
      braintreeClient: 'https://js.braintreegateway.com/web/3.15.0/js/client.min',
      braintreePaypal: 'https://js.braintreegateway.com/web/3.15.0/js/paypal-checkout.min'
    }
  });
    
  require(['braintreeClient', 'braintreePaypal'], function (client, paypalCheckout) {
    var clientToken = document.querySelector('#client_token').value;

    client.create({
      authorization: clientToken
    }, function (err, clientInstance) {
      paypalCheckout.create({
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
          env: 'production', // or 'production | sandbox'
          // set up button
          style: {
            label: 'checkout', // checkout || credit
            size:  'small',    // tiny | small | medium
            shape: 'rect',     // pill | rect
            color: 'blue'      // gold | blue | silver
          },

          payment: function () {
            return paypalCheckoutInstance.createPayment({
              flow: 'checkout', // Required
              amount: '10.00', // Required
              currency: 'GBP', // Required
              locale: 'en_GB',
              enableShippingAddress: false
            });
          },
          onAuthorize: function (data, actions) {
            return paypalCheckoutInstance.tokenizePayment(data)
              .then(function (payload) {
                return paypal.request.post('/subscribe/payment', {
                    payment_method_nonce: payload.nonce
                 }).then(function(data) {
                  document.querySelector('.alert--error').style.display = 'none';
                  document.querySelector('.paypal-container')
                    .innerText = 'Payment Complete! You are now a member';
                 }).catch(function(err) {});
            });
          },

          onCancel: function (data) {
            console.log('checkout.js payment cancelled', JSON.stringify(data, 0, 2));

            var flash = document.querySelector('.alert') !== null;
            if (flash) {
              flash.style.display = 'none';
            }          

            var alert = document.createElement("div");
            alert.className = 'alert alert--error';
            alert.innerHTML = "Your payment was cancelled, please try again";
            document.querySelector(".page__body").prepend(alert);
          },
          onError: function (err) {
            console.error('checkout.js error', err);

            var flash = document.querySelector('.alert') !== null;
            if (flash) {
              flash.style.display = 'none';
            }

            var alert = document.createElement("div");
            alert.className = 'There was an error processing your payment, please try again';
            alert.innerHTML = "Your payment was cancelled, please try again";
            document.querySelector(".page__body").prepend(alert);
          }
        }, '#paypal-button').then(function () {
          // show the paypal button when it's ready to use
          paypalButton.style.display = '';
        });



      });
    });

  });

}