<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userId');
            $table->bigInteger('tenantName');
            $table->bigInteger('propertyName');
            $table->bigInteger('unitName')->nullable();
            $table->string('PaidAmount');
            $table->string('advanceAmt');
            $table->string('dueAmount');
            $table->tinyInteger('method');
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
        Schema::dropIfExists('payments');
    }
}
