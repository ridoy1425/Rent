<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_collections', function (Blueprint $table) {
            $table->id();
            $table->string('propertyContractId',10);
            $table->string('totalAmount',10);
            $table->string('dueAmount',10)->default('0');
            $table->date('paymentDate');          
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
        Schema::dropIfExists('bill_collections');
    }
}
