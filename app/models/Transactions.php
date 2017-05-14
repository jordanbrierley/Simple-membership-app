<?php

class Transactions extends Eloquent  {


  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'transactions';

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  // protected $hidden = array('password', 'remember_token');

  public $fillable = [
    'status',
    'amount',
    'details'
  ];

  /**
   * Validation rules
   */
  public $rules = [
      'status'    => 'required',
      'amount' => 'required'
  ];


  public function user()
  {
      return $this->belongsTo('User');
  }

  

}
