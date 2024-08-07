<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('ID_User');
            $table->string('NameUser', 200)->notNullable();
            $table->string('EmailUser', 200)->notNullable()->unique();
            $table->string('MobilePhoneUser', 15)->notNullable();
            $table->string('SecurityQuestion', 200)->notNullable();
            $table->string('Answer', 200)->notNullable();
            $table->string('Password', 200)->notNullable();
            $table->enum('UserPosition', ['Super Admin', 'Admin/Finance', 'Sales', 'Technical', 'Manager']);
            $table->enum('UserStatus', ['Reject', 'Approve'])->default('Reject');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}