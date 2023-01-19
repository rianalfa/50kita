<?php

use App\Models\User;
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
        Schema::table('task_mails', function (Blueprint $table) {
            $table->string('code', 200);
            $table->string('number')->default('001');
            $table->foreignIdFor(User::class)->default(1);
            $table->text('place')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_mails', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('number');
            $table->dropColumn('user_id');
            $table->dropColumn('place');
        });
    }
};
