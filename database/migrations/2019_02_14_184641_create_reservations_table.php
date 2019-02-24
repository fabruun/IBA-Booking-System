<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rekvirantid');
            $table->foreign('rekvirantid')
                ->references('rekvirentid')
                ->on('rekvirents')
                ->onDelete('cascade');
            $table->string('roomid');
            $table->foreign('roomid')
                ->references('roomid')
                ->on('rooms')
                ->onDelete('cascade');
            $table->date('dato');
            $table->time('tid');
            $table->unique(['tid', 'roomid', 'dato']);
            $table->unique(['dato', 'roomid', 'tid']);
            $table->unique(['dato', 'tid', 'rekvirantid']);
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
        Schema::dropIfExists('reservations');
    }
}
