<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id')->comment('	');
            $table->integer('id_company')->nullable();
            $table->string('name', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('password', 100)->nullable();
            $table->integer('group')->nullable();
            $table->string('status', 5)->default('A');
            $table->date('birth')->nullable();
            $table->string('rg', 45)->nullable();
            $table->string('cpf', 45)->nullable();
            $table->string('civil_status', 45)->nullable();
            $table->string('profession', 45)->nullable();
            $table->string('address', 45)->nullable();
            $table->string('address_number', 45)->nullable();
            $table->string('complement', 45)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('neighborhood', 45)->nullable();
            $table->string('uf', 45)->nullable();
            $table->string('zip_code', 45)->nullable();
            $table->date('start_date')->nullable();
            $table->string('health_plan', 45)->nullable();
            $table->string('how_met', 45)->nullable();
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
