<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create(
            'questions',
             function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');

           
                //$table->integer('user_id')->unsigned();
                $table->string('name');
                $table->string('a');
                $table->string('b');
                $table->string('c');
                $table->string('d');
                $table->integer('answer');
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
        //
        Schema::drop('questions');
    }
}
