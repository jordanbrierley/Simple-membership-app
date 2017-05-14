<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showWelcome'));

Route::group(array('before'=>'guest'),function() { 

  Route::get('users/register',array('as'=>'users-register','uses'=>'UserController@getCreate')); 
  Route::get('users/login',array('as'=>'users-login','uses'=>'UserController@getLogin')); 

  Route::group(array('before'=>'csrf'),function() { 
    Route::post('users/register',array('as'=>'post-users-register','uses'=>'UserController@postCreate')); 
    Route::post('users/login',array('as'=>'post-users-login','uses'=>'UserController@postLogin')); 
  }); 
});

Route::get('users/logout', 'UserController@logout');

Route::group(array('before'=>'auth'),function() { 

  Route::get('account/profile',array('as'=>'account','uses'=>'UserController@getProfile')); 
  Route::post('account/profile',array('as'=>'post-account','uses'=>'UserController@postProfile'));

  Route::get('subscribe/payment',array('as'=>'subscribe-payment','uses'=>'PaymentController@payment'));
  Route::post('subscribe/payment',array('as'=>'post-subscribe-payment','uses'=>'PaymentController@postPayment'));

});


Route::group(array('before'=>'auth|member'),function() { 
  Route::get('members',array('as'=>'members','uses'=>'MembersController@members')); 
  Route::get('file/{filename}/{download?}', 'FileController@getFile')->where('filename', '^[^/]+$');
});


Route::post('payment', array(
    'as' => 'payment',
    'uses' => 'PaymentController@postPayment',
));
// this is after make the payment, PayPal redirect back to your site
Route::get('payment/status', array(
    'as' => 'payment.status',
    'uses' => 'PaymentController@getPaymentStatus',
));