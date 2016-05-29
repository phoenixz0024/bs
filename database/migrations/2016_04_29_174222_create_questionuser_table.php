<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'question_user',
             function (Blueprint $table) {
                $table->engine = 'InnoDB';
               

               $table->integer('question_id')->unsigned()->index();
                $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

                $table->integer('user_id')->unsigned()->index();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

                $table->integer('test_id')->unsigned()->index();
                

                $table->integer('answer');
                $table->integer('correct');

                $table->integer('questionmade')->default(0);
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
    }
}
