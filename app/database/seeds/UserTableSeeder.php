<?php 

class UserTableSeeder extends Seeder {

  public function run()
  {
    Eloquent::unguard();
    
    DB::table('users')->delete();

    $user = User::create(array(
      'username' => 'user',
      'first_name' => 'Joe',
      'surname' => 'Bloggs',
      'email' => 'user@example.com',
      'password' => Hash::make('user')
    ));

    $user = User::create(array(
      'username' => 'member',
      'first_name' => 'John',
      'surname' => 'Wick',
      'email' => 'member@example.com',
      'password' => Hash::make('member'),
      'is_member' => 1
    ));
  }

}

