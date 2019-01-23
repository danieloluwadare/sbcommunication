<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToParcelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('parcels', function(Blueprint $table)
		{
			$table->foreign('placed_by', 'placed_by_fk1')->references('id')->on('admin_users')->onUpdate('CASCADE')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('parcels', function(Blueprint $table)
		{
			$table->dropForeign('placed_by_fk1');
		});
	}

}
