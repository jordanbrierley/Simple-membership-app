<?php 

/**
* a simple user controller that allows users to login, register and logout
*/

class UserController extends BaseController
{

  protected $layout = 'layouts/default';
  /**
   * return the user register view
   */
	public function getCreate()
	{
    $this->layout->content = View::make('pages/users-register');
	}
	
  /**
   * return the user login view
   */
	public function getLogin()
	{
     $this->layout->content = View::make('pages/users-login');
	}

  /**
   * logout and return to the homepage with simple flash message
   */
  public function logout()
  {
    Auth::logout();
    Session::flash('status', 'You have been logged out successfully!');
    return Redirect::route('home');
  }

  /**
   * if we have some posted data, validate and if successful create a new user
   */
	public function postCreate()
	{
    // validate our input
    $validation = Validator::make(Input::all(),
      [
        'username'=>'required|max:255|unique:users,username', // user name must be unique value in the users table
        'email' => 'required|max:255|unique:users,email', // the email must be a unique value
        'password'=>'required', // we just need thte password
      ]
    );

    if($validation->fails()){
      // if the validation fails, return to the user-register view with errors so the user can fix up
      return Redirect::route('users-register')->withInput()->withErrors($validation->messages());
    }
    else
    { 
      // looks like validation has passed, create a new instance of User model and insert that 
      $user = new User();
      // I could have used $user->fill($data) here but because theres only 3 fields and I need to hash the password ill just do line by line for now
      $user->username = Input::get('username');
      $user->email = Input::get('email');
      $user->password = Hash::make(Input::get('password')); // hash the password to add abit more security
      $user->save();

      // all done, redirect the user to the login screen
      return Redirect::route('users-login');
    }
    $this->layout->content = View::make('pages/users-register'); // if we get this far show the register screen
	}

  public function postLogin()
  {
    // validate user input
    $validation = Validator::make(Input::all(),
      array(
        'username'=>'required',
        'password'=>'required',
      )
    );

    if($validation->fails()){
      // if user validation fails, send the user back to the login screen with errors
      return Redirect::route('users-login')->withInput()->withErrors($validation->messages());
    }
    else
    {
      // check if the user wants to be remembered
      $remember = (Input::has('remember')) ? true : false;

      $user = User::where('username', Input::get('username'))->first();
      if(!$user) return Redirect::back()->withInput()->withErrors('Unknown username.');

      // try and authenticate the user credentials
      $auth = Auth::attempt(array(
        'username' => Input::get('username'),
        'password' => Input::get('password')
        ), $remember);

      if($auth)
      {
        Session::flash('success', 'You have been successfully logged in!');
        if (isset(Auth::getUser()->is_member) && Auth::getUser()->is_member == true) {
          return Redirect::route('members');
        }
        return Redirect::route('subscribe-payment');
      }
      else
      {
        return Redirect::back()->withInput()->withErrors('Wrong username/password combination.');
      }
    }



  }

  public function getProfile()
  {
    $user = Auth::getUser();
    $this->layout->content = View::make('pages/users-profile', compact('user'));
  }

  public function postProfile()
  {
    try {


      $user = Auth::getUser();
      $user->fill(Input::all());
      $user->save();

      /*
         * Password has changed, reauthenticate the user
         */
        if (strlen(Input::get('password'))) {
            Auth::login($user->reload(), true);
        }


    }
    catch (Exception $ex) {
      if (Request::ajax()) throw $ex;
      else Session::flash('error', $ex->getMessage());
    }    
    Session::flash('success', 'Your account has been updated');

    $this->layout->content = View::make('pages/users-profile', compact('user'));
  }

}

 ?>