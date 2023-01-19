<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('function', 150)->nullable();
            $table->string('nip', 100)->nullable();
            $table->string('class', 150)->nullable();
            $table->string('rank', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('function');
            $table->dropColumn('nip');
            $table->dropColumn('class');
            $table->dropColumn('rank');
        });
    }
};
