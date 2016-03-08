<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrandbpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrandbps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId');
            $table->float('hr');
            $table->float('hbp');
            $table->float('lbp');
            $table->timestamp('time');

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
        Schema::drop('hrandbps');
    }
}
