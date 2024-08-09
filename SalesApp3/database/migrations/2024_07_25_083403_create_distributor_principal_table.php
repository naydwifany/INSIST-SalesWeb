<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorPrincipalTable extends Migration
{
    public function up()
    {
        Schema::create('distributor_principal', function (Blueprint $table) {
            $table->unsignedInteger('ID_Distributor');
            $table->unsignedInteger('ID_Principal');
            $table->foreign('ID_Distributor')->references('ID_Distributor')->on('distributors')->onDelete('cascade');
            $table->foreign('ID_Principal')->references('ID_Principal')->on('principals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('distributor_principal');
    }
}