<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDistpicPhoneToStringInDistributorpicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distributorpics', function (Blueprint $table) {
            $table->string('DistPIC_Phone', 15)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distributorpics', function (Blueprint $table) {
            $table->integer('DistPIC_Phone')->change();
        });
    }
}
