<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clientpics', function (Blueprint $table) {
            $table->increments('Client_PIC_ID');
            $table->unsignedInteger('Client_Name');
            $table->string('ClientPIC_Name', 200);
            $table->string('ClientPIC_JobPosition', 50);
            $table->string('ClientPIC_Phone', 15);
            $table->string('ClientPIC_Email', 200)->nullable();
            $table->timestamps();

            $table->foreign('Client_Name')->references('ID_Client')->on('clients');
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientpics');
    }
};
