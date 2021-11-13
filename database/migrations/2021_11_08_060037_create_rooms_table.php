<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('id');
            $table->text('agent')->nullable();
            $table->text('visitor')->nullable();
            $table->text('agenturl')->nullable();
            $table->text('visitorurl')->nullable();
            $table->string('password')->nullable();
            $table->string('roomId')->nullable();
            $table->string('datetime')->nullable();
            $table->text('duration')->nullable();
            $table->text('shortagenturl')->nullable();
            $table->text('shortvisitorurl')->nullable();
            $table->text('agent_id')->nullable();
            $table->integer('is_active')->default(0);
            $table->text('agenturl_broadcast')->nullable();
            $table->text('visitorurl_broadcast')->nullable();
            $table->text('shortagenturl_broadcast')->nullable();
            $table->text('shortvisitorurl_broadcast')->nullable();
            $table->text('title')->nullable();
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
        Schema::drop('rooms');
    }
}
