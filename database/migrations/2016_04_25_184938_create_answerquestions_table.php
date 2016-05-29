<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerquestionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create(
            'answer_questions',
             function (Blueprint $table) {
                $table->engine = 'InnoDB';
               

               $table->integer('answer_id')->unsigned()->index();
                $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');

                $table->integer('question_id')->unsigned()->index();
                $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

                

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
          Schema::drop('answer_questions');
    }


}
