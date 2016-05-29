<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'jobs_users',
             function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('user_id')->unsigned()->index();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

                $table->integer('job_id')->unsigned()->index();
                $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');

                $table->integer('bonus_id')->unsigned()->index()->nullable();
               // $table->foreign('bonus_id')->references('id')->on('bonus')->onDelete('cascade');

                $table->integer('sales')->unsigned();
                
                $table->integer('earnings')->unsigned();
                $table->integer('nonesales')->unsigned();
                $table->string('comment');

                $table->timestamps();

            });

         Schema::table('jobs_users', function($table) {
                $table->engine = 'InnoDB';
             $table->foreign('bonus_id')->references('id')->on('bonus')->nullable();
              
   });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs_users');
    }
}
