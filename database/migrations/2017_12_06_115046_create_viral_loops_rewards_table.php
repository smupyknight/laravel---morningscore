<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViralLoopsRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viral_loops_rewards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('viral_loops_user_id');
            $table->string('viral_loops_id')->unique();
            $table->string('reward_name');
            $table->boolean('is_redeemed')->default(false);
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
        Schema::dropIfExists('viral_loops_rewards');
    }
}
