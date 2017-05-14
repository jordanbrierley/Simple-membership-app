<?php 

/**
 * Payment controller to handle paypal payments using the Braintree client side SDK 
 */
class PaymentController extends BaseController
{

  private $access_token;
  protected $layout = 'layouts/default';
  
  public function __construct()
  {
      $this->access_token = $_ENV['PAYPAL_BRAINTREE_SDK_TOKEN'];
  }

  /**
   * Returns the view with the client token used for the Paypal
   */
  public function payment()
  {
    //  create a new instance of the braintree gateway passing in our access token
    $gateway = new Braintree_Gateway(array(
        'accessToken' => $this->access_token,
    ));
    // generate our client token
    $clientToken = $gateway->clientToken()->generate();
    // pass this into along with the view so we can access it
    $this->layout->content = View::make('pages/subscribe-payment')->with('client_token', $clientToken);
  }


  /**
   * Retrievs the data from paypal and creates a server side payment 
   * and if successful saves the transaction and upgrades the user to a member
   */
  public function postPayment()
  {
    $data = Input::all();

    // create new instance of braintree gateway using our access token
    $gateway = new Braintree_Gateway(array(
      'accessToken' => $this->access_token,
    ));
    // try and create a sale using the gateway and payment nonce received from paypal
    $result = $gateway->transaction()->sale([
        "amount" => '10.00',
        'merchantAccountId' => 'GBP',
        "paymentMethodNonce" => $data['payment_method_nonce']
    ]);
    // if we're successful
    if ($result->success) {


      // update user
      $user = Auth::getUser();
      $user->is_member = true;
      $user->member_at = \Carbon\Carbon::now();
      $user->save();

      // set up transaction variables
      $transaction = $result->transaction;
      $status = $transaction->status;
      $amount = $transaction->amount;
      $details = json_encode($transaction->paypal);
      // create new transaction
      $payment = new Transactions([
          'status' => $status,
          'amount' => $amount,
          'details' => $details,
      ]);
      // save new transaction to the user
      $payment = $user->transactions()->save($payment);
      // return success
      return json_encode(['success' => 'Payment Successfull', 'transaction_id' => $result->transaction->id]);
    } else {
      return json_encode(['error', $result->message]);
    }
  }



}





 ?>