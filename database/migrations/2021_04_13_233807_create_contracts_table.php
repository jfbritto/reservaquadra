<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_plan');
            $table->integer('id_user');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('expiration_day', 5);
            $table->string('status', 5)->default('A');
            $table->decimal('price_per_month', 10);
            $table->integer('parcel')->nullable();
            $table->dateTime('cancel_date')->nullable();
            $table->integer('id_user_canceled')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
