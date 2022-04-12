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
            $table->string('propertyName',10);
            $table->string('houseBill',10);
            $table->string('gasBill',10);
            $table->string('waterBill',10);
            $table->string('utilityBill',10);
            $table->string('advanceBill',10);
            $table->string('flatNumber',10)->nullable();
            $table->json('otherBill')->nullable();
            $table->string('tenentName',50);
            $table->string('tenentAddress',100);
            $table->string('tenentPhone',11);
            $table->string('tenentProfession',50)->nullable();
            $table->string('tenentNID',50);
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
