<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('location_shipments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('shipment_id')->unsigned();
            $table->foreign('shipment_id')->references('id')->on('shipments')->onUpdate('cascade')->onDelete('cascade');
            
            $table->float('latitude', 10, 6);
            $table->float('longitude', 10, 6);
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('location_shipments');
        Schema::enableForeignKeyConstraints();
    }
}
