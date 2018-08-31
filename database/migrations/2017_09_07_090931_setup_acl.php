<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupAcl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('name')->nullable();
            $table->string('node_path')->default('/');
            $table->boolean('super')->default(false);
            $table->timestamps();
        });

        Schema::create('roleables', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('roleable_id')->unsigned();
            $table->string('roleable_type');

            $table
                ->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roleables');
        Schema::dropIfExists('roles');
    }
}
