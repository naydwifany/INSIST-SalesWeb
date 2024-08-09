<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorPicsTable extends Migration
{
    public function up()
    {
        Schema::create('distributorpics', function (Blueprint $table) {
            $table->increments('Distributor_PIC_ID');
            $table->unsignedInteger('Distributor_Name');
            $table->string('DistPIC_Name', 200);
            $table->string('DistPIC_JobPosition', 50);
            $table->string('DistPIC_Phone', 15);
            $table->string('DistPIC_Email', 200)->nullable();
            $table->timestamps();

            $table->foreign('Distributor_Name')->references('ID_Distributor')->on('distributors');
        });
    }

    public function down()
    {
        Schema::dropIfExists('distributorpics');
    }
}