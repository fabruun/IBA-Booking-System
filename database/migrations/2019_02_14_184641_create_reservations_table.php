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
            $table->string('rekvirantid');
            $table->foreign('rekvirantid')
                ->references('uid')
                ->on('users')
                ->onDelete('cascade');
            $table->string('roomid');
            $table->foreign('roomid')
                ->references('roomid')
                ->on('rooms')
                ->onDelete('cascade');
            $table->time('tid');
            $table->unique('tid');
            $table->primary(['roomid', 'tid']);
            $table->unique(['tid','rekvirantid']);
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
