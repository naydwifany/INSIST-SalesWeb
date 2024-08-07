<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('ID_Client');
            $table->string('Client_Name', 200)->nullable(false);
            $table->unsignedInteger('NameUser');
            $table->string('Client_Address', 200)->nullable(false);
            $table->string('Client_TaxID', 20)->nullable();
            $table->enum('Category', [
                'Financial Service Industry', 
                'Government', 
                'Hospital', 
                'Education', 
                'Hotel', 
                'Military', 
                'Private'
            ])->nullable(false);
            $table->string('Bandwidth', 200)->nullable();
            $table->bigInteger('TotalEndpoint')->nullable();
            $table->string('DataCenterModel', 20)->nullable();
            $table->bigInteger('ConcurrentUser')->nullable();
            $table->string('InternalNotes', 200)->nullable();
            $table->timestamps();

            $table->foreign('NameUser')->references('ID_User')->on('users');
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['NameUser']);
        });

        Schema::dropIfExists('clients');
    }
}