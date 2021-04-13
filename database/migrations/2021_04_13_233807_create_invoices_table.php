<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->nullable();
            $table->integer('id_contract')->nullable();
            $table->dateTime('generate_date');
            $table->integer('id_user_generated');
            $table->string('status', 5)->default('A');
            $table->date('due_date');
            $table->decimal('price', 10);
            $table->decimal('discount', 10)->nullable();
            $table->decimal('paid_price', 10)->nullable();
            $table->dateTime('paid_date')->nullable();
            $table->integer('id_user_received')->nullable();
            $table->dateTime('cancel_date')->nullable();
            $table->integer('id_user_canceled')->nullable();
            $table->integer('id_type');
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
        Schema::dropIfExists('invoices');
    }
}
