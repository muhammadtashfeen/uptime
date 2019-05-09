<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDowntimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downtime', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('server_id');
            $table->foreign('server_id')
                    ->references('id')
                    ->on('servers')
                    ->onDelete('cascade');
            $table->float('down_time');
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
        Schema::dropIfExists('downtime');
    }
}
