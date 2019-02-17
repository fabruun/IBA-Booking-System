<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->string('adminid');
            $table->primary('adminid');
            $table->string('adminsig');
            /*$table->foreign('adminid')
                  ->references('uid')
                  ->on('users')
                  ->onDelete('cascade');*/
            $table->enum('type', ['admin']);
            $table->foreign('type')
                  ->references('type')
                  ->on('users')
                  ->onDelete('cascade');
            $table->string('name');
            $table->string('email');
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
        Schema::dropIfExists('admins');
    }
}
