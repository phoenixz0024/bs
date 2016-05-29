<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create(
            'tests_users',
             function (Blueprint $table) {
                $table->engine = 'InnoDB';
            

               $table->integer('user_id')->unsigned()->index();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

                $table->integer('test_id')->unsigned()->index();
                $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
                
                $table->integer('testscore');
                //$table->integer('sales');
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
          Schema::drop('tests_users');
    }
}
