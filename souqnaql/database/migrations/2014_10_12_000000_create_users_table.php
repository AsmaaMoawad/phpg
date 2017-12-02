<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('Name');
            $table->string('Name_Company')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password');
            $table->string('PersonalImage')->nullable()->default('default.png');
            $table->string('phone_number')->nullable()->unique();
            $table->integer('Age')->nullable();
            $table->string('Address')->nullable();
            $table->string('Governorate')->nullable();
            $table->string('licenceNo')->nullable();
            $table->string('Activity')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('users');
    }
}
