<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('nickname')->nullable();
			$table->string('email')->unique();
			$table->string('password')->nullable();
			$table->rememberToken();
			$table->string('avatar')->nullable();
			$table->string('lang')->nullable();
			$table->timestamp('last_login')->nullable();
			$table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('users');
    }
}
