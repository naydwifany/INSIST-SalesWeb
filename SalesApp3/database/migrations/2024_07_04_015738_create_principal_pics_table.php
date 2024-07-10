<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrincipalPicsTable extends Migration
{
    public function up()
    {
        Schema::create('principalpics', function (Blueprint $table) {
            $table->increments('Principal_PIC_ID');
            $table->unsignedInteger('ID_Principal');
            $table->string('PrincipalName', 200);
            $table->string('PrincipalJobPosition', 50);
            $table->bigInteger('PrincipalPhone');
            $table->string('PrincipalEmail', 200)->nullable();
            $table->timestamps();

            $table->foreign('ID_Principal')->references('ID_Principal')->on('principals')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('principalpics');
    }
}