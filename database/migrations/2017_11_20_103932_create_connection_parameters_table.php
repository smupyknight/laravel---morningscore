<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connection_parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('connection_id');
            $table->integer('domain_id')->nullable();
            $table->string('parameter_key');
            $table->string('parameter_value');
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
        Schema::dropIfExists('connection_parameters');
    }
}
