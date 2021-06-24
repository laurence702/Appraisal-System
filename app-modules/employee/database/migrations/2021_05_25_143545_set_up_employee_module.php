<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SetUpEmployeeModule extends Migration
{
	public function up()
	{
		// Schema::create('employee', function(Blueprint $table) {
		// 	$table->bigIncrements('id');
		// 	$table->timestamps();
		// 	$table->softDeletes();
		// });
	}
	
	public function down()
	{
		// Schema::dropIfExists('employee');
	}
}
