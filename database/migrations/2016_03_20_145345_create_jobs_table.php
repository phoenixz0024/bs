<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('location');
            $table->timestamp('startDate');
            $table->string('startTime');
            $table->string('comment');
            $table->integer('saleswaarde');
            //$table->integer('sales');
            $table->timestamps();

            // $table->foreign('user_id')
            //       ->references('id')
            //       ->on('users');
                  //->onDelete('cascade')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs');
    }
}
