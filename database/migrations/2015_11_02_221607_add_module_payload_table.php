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
            $table->string('sub_hub_api', 250);
            $table->string('module_id', 250);
            $table->integer('module_type');
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
