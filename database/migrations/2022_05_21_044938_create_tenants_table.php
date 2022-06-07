<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userId');
            $table->string('name',100);
            $table->string('phone',20);
            $table->string('email',100);
            $table->string('nidNo',30);
            $table->text('address');
            $table->string('image');
            $table->string('ocupation',50);
            $table->string('workPlace',50);
            $table->string('relation',50);
            $table->string('relativeName',100);
            $table->string('relativePhone',20);            
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
        Schema::dropIfExists('tenants');
    }
}
