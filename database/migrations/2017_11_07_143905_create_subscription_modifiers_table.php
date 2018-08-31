<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionModifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_modifiers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('modifiable_id')->unsigned();
            $table->string('modifiable_type');
            $table->decimal('amount', 16, 2);
            $table->integer('modifier_type');
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
        Schema::dropIfExists('subscription_modifiers');
    }
}
