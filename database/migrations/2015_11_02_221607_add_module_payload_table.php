<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModulePayloadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_payload', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('hub_id')->references('id')->on('hubs');
            $table->integer('module_id');
            $table->json('payload');
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
        Schema::drop('module_payload');
    }
}
