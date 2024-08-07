<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrincipalsTable extends Migration
{
    public function up()
    {
        Schema::create('principals', function (Blueprint $table) {
            $table->increments('ID_Principal');
            $table->string('Brand', 200)->unique();
            $table->string('PrincipalAddress', 200);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('principals');
    }
}