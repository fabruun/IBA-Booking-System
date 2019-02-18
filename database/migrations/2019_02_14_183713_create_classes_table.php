<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->string('classid');
            $table->primary('classid');
            $table->string('classname');
            /*$table->foreign('classname')
                  ->references('uid')
                  ->on('users')
                  ->onDelete('cascade');*/
            $table->enum('type', ['class']);
            $table->foreign('type')
                  ->references('type')
                  ->on('users')
                  ->onDelete('cascade');
            $table->string('teacher');
            $table->smallInteger('numberofstudents')->unsigned();
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
        Schema::dropIfExists('classes');
    }
}
