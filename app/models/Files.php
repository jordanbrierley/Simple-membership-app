<?php

class Files extends Eloquent  {


  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'files';

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  // protected $hidden = array('password', 'remember_token');

  public $fillable = [
    'code',
    'filename',
    'species'
  ];

  /**
   * Validation rules
   */
  public $rules = [
      'code'    => 'required|between:6,255|unique:files',
      'filename' => 'required|between:2,255|unique:files'
  ];

  

}
