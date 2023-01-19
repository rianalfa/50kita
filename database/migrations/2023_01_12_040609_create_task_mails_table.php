<?php

use App\Models\Task;
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
        Schema::create('task_mails', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Task::class);
            $table->unsignedTinyInteger('status')->default(0);
            $table->date('sent_at')->nullable();
            $table->date('accepted_at')->nullable();
            $table->date('paid_at')->nullable();
            $table->text('note')->default('');
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
        Schema::dropIfExists('task_mails');
    }
};
