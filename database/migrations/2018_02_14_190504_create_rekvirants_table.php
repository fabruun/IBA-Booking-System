<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekvirantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekvirants', function (Blueprint $table) {
            $table->string('id');
            $table->string('rekvirantid');
            $table->foreign('rekvirantid')->references('uid')->on('users');
            $table->unique('rekvirantid', 'id');
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
        Schema::dropIfExists('rekvirants');
    }
}
