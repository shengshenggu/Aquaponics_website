<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvironmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->timestamp('datetime');
            $table->double('temp', 12, 2)->nullable();
            $table->double('water', 12, 2)->nullable();
            $table->double('pH', 12, 2)->nullable();
            $table->double('light', 12, 2)->nullable();
            $table->double('ndvi', 12, 2)->nullable();
            $table->timestamps();
            $table->index(['user_id', 'datetime']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('environments');
    }
}
