<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledClassesResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_classes_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_scheduled_classes');
            $table->integer('id_teacher')->nullable();
            $table->string('status', 5);
            $table->string('result', 5);
            $table->date('date');
            $table->date('date_remarked')->nullable();
            $table->integer('id_scheduled_classes_result_remarked')->nullable();
            $table->text('observation')->nullable();
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
        Schema::dropIfExists('scheduled_classes_results');
    }
}
