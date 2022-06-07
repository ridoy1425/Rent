<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userId');
            $table->bigInteger('tenantName');
            $table->bigInteger('propertyName');
            $table->bigInteger('unitName')->nullable();
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
        Schema::dropIfExists('payment_details');
    }
}
