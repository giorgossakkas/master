<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name',256);
            $table->string('description',1024);
            $table->string('status',32);
            $table->foreignId('assign_to_user_id')->nullable();
            $table->foreign('assign_to_user_id')->references('id')->on('users');
            $table->foreignId('owner_user_id')->nullable();
            $table->foreign('owner_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('tasks');
    }
}
