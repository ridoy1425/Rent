<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_properties', function (Blueprint $table) {
            $table->id();
            $table->string('propertyName',50);
            $table->string('propertyType',50);
            $table->string('location',255);
            $table->string('propertySize',100);
            $table->string('numbersOfRooms',10);
            $table->string('numbersOfWashrooms',10);
            $table->string('carParking',5);
            $table->string('securitySystem',20);
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
        Schema::dropIfExists('add_properties');
    }
}
