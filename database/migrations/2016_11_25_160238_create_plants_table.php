<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('eng_name');
            $table->string('chi_name');
            $table->string('description');
            $table->double('temp_max', 10, 2);
            $table->double('temp_min', 10, 2);
            $table->double('water_max', 10, 2)->nullable()->default(25);
            $table->double('water_min', 10, 2)->nullable()->default(0);
            $table->double('pH_max', 10, 2);
            $table->double('pH_min', 10, 2);
            $table->integer('cropcycle_min');
            $table->integer('cropcycle_max');
            $table->integer('photoperiod_min');
            $table->integer('photoperiod_max');
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
        Schema::dropIfExists('plants');
    }
}
