<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('teachers', function (Blueprint $table) {
        $table->id();
        $table->string('Name');
        $table->string('Password');
        $table->bigInteger('specialization_id')->unsigned();
        $table->foreign('specialization_id')->references('id')->on('specializations')->cascadeOnDelete();
        $table->bigInteger('Gender_id')->unsigned();
        $table->foreign('Gender_id')->references('id')->on('genders')->cascadeOnDelete();
        $table->date('Joining_Date');
        $table->text('Address');
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
        Schema::dropIfExists('teachers');
    }
}
