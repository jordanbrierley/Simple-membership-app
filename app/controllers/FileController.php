<?php 

/**
* file controller to protect our members images from being accessed and downloaded
*/
class FileController extends BaseController
{


  /**
   * Retreives the files and check if the user has access and whether they want to downoad or just view
   */
  public function getFile($code, $download = null)
  {
    // an extra check in here just to make sure the user is a member
    $user = Auth::getUser();
    if (isset($user->is_member) && $user->is_member == true) {
      $file = Files::where('code', $code)->first();
      
      // if file exists in our database
      if ($file) {
        // if download property = download let the user download the file directly
        if($download == 'download') $download = true;

        // return the image
        return Response::download(storage_path('resources/'.$file->filename), null, [], $download);
      }
      else{
        // image doesnt exists, oops
        App::abort(404);
      }
    }
    // we dont have access, lets get out of here and subscribe
    Session::flash('status', 'You must be a member to download our awesome pictures!');
    return Redirect::guest('subscribe/payment');
  }
}

 ?>