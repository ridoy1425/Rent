<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userId');
            $table->string('propertyName',50);
            $table->string('unitName',50)->nullable();
            $table->string('houseRent',10);
            $table->string('deposit',10)->nullable();
            $table->string('gasBill',50)->nullable();
            $table->tinyInteger('electricity');
            $table->string('electricBill',50)->nullable();
            $table->string('electricIniUnit',50)->nullable();
            $table->string('electricUnitCost',50)->nullable();
            $table->tinyInteger('water');
            $table->string('waterBill',50)->nullable();
            $table->string('waterIniUnit',50)->nullable();
            $table->string('waterUnitCost',50)->nullable();
            $table->string('carParkingBill',50)->nullable();
            $table->string('guardBill',50)->nullable();
            $table->string('elevatorBill',50)->nullable();
            $table->string('securityBill',50)->nullable();
            $table->string('internetBill',50)->nullable();
            $table->json('othersBill')->nullable();
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
        Schema::dropIfExists('units');
    }
}
