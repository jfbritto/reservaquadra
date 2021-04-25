<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_company');
            $table->dateTime('generate_date');
            $table->integer('id_user_generated');
            $table->date('due_date');
            $table->string('status', 5)->default('A');
            $table->decimal('price', 10);
            $table->dateTime('paid_date')->nullable();
            $table->integer('id_user_paid')->nullable();
            $table->integer('id_cost_center');
            $table->integer('id_cost_center_subtype');
            $table->text('observation')->nullable();
            $table->string('nfe', 50)->nullable();
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
        Schema::dropIfExists('expenses');
    }
}
