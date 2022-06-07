<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('present_units', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userId');
            $table->bigInteger('tenantName');
            $table->bigInteger('propertyName');
            $table->bigInteger('unitName')->nullable();
            $table->string('electricPreUnit',50)->nullable();
            $table->string('waterPreUnit',50)->nullable();
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
        Schema::dropIfExists('present_units');
    }
}
