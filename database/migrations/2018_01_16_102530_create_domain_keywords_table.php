<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_keywords', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('domain_id')->unsigned();
            $table->integer('locale_id')->unsigned();
            $table->string('keyword');
            $table->boolean('active')->default(true);
            $table->boolean('is_synced')->default(false);
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
        Schema::dropIfExists('domain_keywords');
    }
}
