<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'answers',
             function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');

               $table->integer('user_id')->unsigned()->index();
               



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
        Schema::down('answers');
    }
}
