<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('postcode');
            $table->string('street');
            $table->string('housenumber');
            $table->string('city');
            $table->string('phone');
            $table->string('birthdate');
            $table->string('birthplace');
            $table->string('birthcountry');
            $table->enum('gender',['Men','Women']);
            $table->enum('license', ['Yes' ,'No']);
            $table->string('licensevalid');
            $table->string('bankaccount');
            $table->string('helpname');
            $table->string('helpnumber');
            $table->integer('totalWage')->unsigned();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
