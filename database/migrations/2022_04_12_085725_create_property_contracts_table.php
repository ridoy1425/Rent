<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('userId',10);
            $table->string('tenentName',50);
            $table->string('tenentAddress',100);
            $table->string('tenentPhone',11);
            $table->string('tenentProfession',50)->nullable();
            $table->string('tenentNID',50);            
            $table->string('propertyName',10);
            $table->string('houseBill',5);
            $table->string('gas',3)->nullable();
            $table->string('water',3)->nullable();
            $table->string('electicity',3)->nullable();
            $table->string('elevator',3)->nullable();
            $table->string('garage',3)->nullable();
            $table->string('guard',3)->nullable();
            $table->string('camera',3)->nullable();
            $table->string('advanceBill',10)->nullable();
            $table->string('gasBill',5)->nullable();
            $table->string('waterIniUnit',5)->nullable();
            $table->string('waterPerCost',5)->nullable();
            $table->string('electicityIniUnit',5)->nullable();
            $table->string('electicityPerCost',5)->nullable();
            $table->string('elevatorBill',5)->nullable();
            $table->string('garageCharge',5)->nullable();
            $table->string('guardBill',5)->nullable();
            $table->string('flatNumber',10)->nullable();
            $table->json('otherBill')->nullable();            
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
        Schema::dropIfExists('property_contracts');
    }
}
