<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotesToPrincipalpicsTable extends Migration
{
    public function up()
    {
        Schema::table('principalpics', function (Blueprint $table) {
            $table->string('Notes', 200)->nullable()->after('PrincipalEmail');
        });
    }

    public function down()
    {
        Schema::table('principalpics', function (Blueprint $table) {
            $table->dropColumn('Notes');
        });
    }
}