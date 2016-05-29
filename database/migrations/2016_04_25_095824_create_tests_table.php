<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
             Schema::create(
            'tests',
             function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');

                //$table->integer('user_id')->unsigned();
                $table->string('name');
                $table->string('modulelink');
                $table->string('comment');
                $table->integer('published')->default(0);
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
        Schema::drop('tests');
    }
}
