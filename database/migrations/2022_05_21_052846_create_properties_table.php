<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userId');
            $table->string('propertyName',50);
            $table->string('propertyType',5);
            $table->string('state',100);
            $table->string('postalCode',10);
            $table->string('city',100);
            $table->string('country',100);
            $table->string('propertyAge',10);
            $table->string('rooms',10);
            $table->string('bedRooms',10);
            $table->string('washrooms',10);
            $table->string('belcony',10);
            $table->string('propertySize',100);
            $table->json('amenities');
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
        Schema::dropIfExists('properties');
    }
}
