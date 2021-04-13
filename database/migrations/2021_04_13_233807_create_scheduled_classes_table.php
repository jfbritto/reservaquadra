<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_court');
            $table->integer('id_user');
            $table->string('week_day', 45);
            $table->string('start_time', 45);
            $table->string('end_time', 45);
            $table->string('status', 5)->default('A');
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
        Schema::dropIfExists('scheduled_classes');
    }
}
