<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function($table)
    {
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->integer('user_id');
        $table->string('status');
        $table->decimal('amount', 10, 2)->nullable()->default(null);
        $table->string('details')->nullable()->default(null);
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
		Schema::dropIfExists('transactions');
	}

}
