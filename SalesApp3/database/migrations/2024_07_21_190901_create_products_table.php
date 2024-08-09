<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('ID_Product');
            $table->unsignedInteger('Brand');
            $table->string('Product_Name', 200)->nullable(false);
            $table->string('Product_Type', 200)->nullable();
            $table->enum('Category', [
                'Hardware', 
                'License', 
                'Guarantee', 
                'Service'
            ])->nullable(false);
            $table->string('Product_Spec', 200)->nullable();
            $table->timestamps();

            $table->foreign('Brand')->references('ID_Principal')->on('principals');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['Brand']);
        });

        Schema::dropIfExists('products');
    }
};