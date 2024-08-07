<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id('ID_Sales');
            $table->date('Sales_Date');
            $table->unsignedBigInteger('Client_Name');
            $table->unsignedBigInteger('ClientPIC_Name');
            $table->unsignedBigInteger('NameUser');
            $table->unsignedBigInteger('Brand');
            $table->unsignedBigInteger('Distributor_Name');
            $table->unsignedBigInteger('Product_Name');
            $table->unsignedBigInteger('Category');
            $table->integer('Quantity');
            $table->decimal('UnitPrice', 12, 2);
            $table->decimal('TotalPrice', 12, 2);
            $table->string('SerialNumber')->nullable();
            $table->date('ExpDate')->nullable();
            $table->string('ContractNumber')->nullable();
            $table->string('SalesNotes')->nullable();

            // Adding foreign key constraints
            $table->foreign('Client_Name')->references('ID_Client')->on('clients');
            $table->foreign('ClientPIC_Name')->references('Client_PIC_ID')->on('clientpics');
            $table->foreign('NameUser')->references('ID_User')->on('users');
            $table->foreign('Brand')->references('ID_Principal')->on('principals');
            $table->foreign('Distributor_Name')->references('ID_Distributor')->on('distributors');
            $table->foreign('Product_Name')->references('ID_Product')->on('products');
            $table->foreign('Category')->references('ID_Product')->on('products');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}