<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration {

	public function up()
	{
		Schema::create('Classrooms', function(Blueprint $table) {
			$table->id();
			$table->string('Name_Class');
			$table->foreignId('Grade_id')->cascadeOnDelete()->cascadeOnUpdate();
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('Classrooms');
	}
}
// $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
// $table->foreign('Grade_id')->references('id')->on('Grades')
// 						->onDelete('cascade')
// 						->onUpdate('cascade');
