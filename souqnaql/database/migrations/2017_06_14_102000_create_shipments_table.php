<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            
            $table->double('price', 15, 2)->nullable();
            $table->string('type');
            $table->float('start_point_latitude', 10, 6);
            $table->float('start_point_longitude', 10, 6);
            $table->string('from');
            $table->float('end_point_latitude', 10, 6);
            $table->float('end_point_longitude', 10, 6);
            $table->string('to');
            $table->string('status')->default('pending');
            $table->string('load_type');
            $table->float('rate', 2)->default(0);
            $table->string('notes')->nullable();
            $table->dateTime('arrival_time')->nullable();
            $table->dateTime('inital_time')->nullable();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('shipments');
        Schema::enableForeignKeyConstraints();
    }
}
