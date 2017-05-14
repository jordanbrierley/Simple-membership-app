<?php 

class FilesTableSeeder extends Seeder {

  public function run()
  {
    DB::table('files')->delete();

    $files = [
      ['filename' => 'mammal.jpg', 'species' => 'mammal'],
      ['filename' => 'fish.jpg', 'species' => 'fish'],
      ['filename' => 'reptile.jpg', 'species' => 'reptile'],
      ['filename' => 'bird.jpg', 'species' => 'bird'],
      ['filename' => 'amphibian.jpg', 'species' => 'amphibian']
    ];

    foreach ($files as $file) {
      $file['code'] = md5($file['filename']. \Carbon\Carbon::now());
      Files::create($file);
    }
  }

}

