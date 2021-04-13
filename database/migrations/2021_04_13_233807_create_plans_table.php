<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_company');
            $table->string('name', 45);
            $table->integer('months');
            $table->integer('age_range');
            $table->integer('day_period');
            $table->integer('lessons_per_week');
            $table->integer('annual_contract');
            $table->decimal('price', 10);
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
        Schema::dropIfExists('plans');
    }
}
