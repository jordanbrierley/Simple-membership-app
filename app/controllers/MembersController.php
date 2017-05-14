<?php 

class MembersController extends BaseController{


  public function members()
  {

    $user = Auth::getUser();
    if ($user->is_member) {

      // group by so we only 
      $files = DB::table('files')
        ->select('code', 'species')
        ->groupBy('species')
        ->orderBy('created_at', 'desc')
        ->get();

      return View::make('pages/members')->with('images', $files);
    }else{
      Session::flash('error', 'You must be a member to download our awesome pictures!');
      return Redirect::route('subscribe-payment');
    }
    return;

  }


}

 ?>