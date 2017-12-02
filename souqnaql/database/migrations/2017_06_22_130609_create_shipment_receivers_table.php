<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentReceiversTable extends Migration
{
    
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('shipment_receivers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('shipment_id')->unsigned();
            $table->foreign('shipment_id')->references('id')->on('shipments')->onUpdate('cascade')->onDelete('cascade');
            
            $table->string('name');
            $table->string('phone_number');
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
        Schema::dropIfExists('shipment_receivers');
        Schema::enableForeignKeyConstraints();
    }
}
