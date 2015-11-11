<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hubs', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('carriage_name', 250)->index();
            $table->integer('client_id')->references('id')->on('clients');
            $table->text('desc')->nullable();
            $table->json('module_configuration');
            $table->string('api_key', 250);
            $table->string('api_enc', 250);
            $table->string('api_user', 250);
            $table->string('api_pass', 250);
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
        Schema::drop('hubs');
    }
}
