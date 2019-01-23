<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParcelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parcels', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('placed_by')->nullable()->index('placed_by_fk1_idx');
			$table->string('weight', 20);
			$table->dateTime('sent_on')->nullable();
			$table->dateTime('deleivered_on')->nullable();
			$table->boolean('status')->nullable()->default(0)->comment('0=pending
1=enroute
2=delivered');
			$table->string('from_address', 50)->nullable();
			$table->string('to_address', 50)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('parcels');
	}

}
