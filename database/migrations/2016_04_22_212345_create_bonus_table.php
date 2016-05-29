<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('bonus', function (Blueprint $table) {
            $table->increments('id');
               
           
            //$table->integer('user_id')->unsigned();
            $table->string('name');
            $table->integer('value');
            $table->integer('nos');
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
        //
         Schema::drop('bonus');
    }
}
