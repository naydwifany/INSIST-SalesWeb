<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserPositions extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('UserPosition')->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('UserPosition', ['Super Admin', 'Admin/Finance', 'Sales', 'Technical'])->change();
        });
    }
}