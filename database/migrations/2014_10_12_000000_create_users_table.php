<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->double('temp_max', 10, 2)->default(36.0);
            $table->double('temp_min', 10, 2)->default(20.0);
            $table->double('pH_max', 10, 2)->default(9.0);
            $table->double('pH_min', 10, 2)->default(5.0);
            $table->integer('period')->default(0);
            $table->boolean('status')->default(false);
            $table->integer('group')->default(0);
            $table->rememberToken();
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
