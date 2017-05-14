<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('files', function($table)
    {
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->string('code')->unique();
        $table->string('filename');
        $table->string('species');
        $table->timestamps();
        // for this example we will just store the unique code and filename in the database, for a full production application wewould store more than this
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('files');
	}

}
