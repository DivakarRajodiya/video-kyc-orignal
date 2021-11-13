<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('message')->nullable();
            $table->string('system')->nullable();
            $table->string('participants')->nullable();
            $table->string('from')->nullable();
            $table->string('agent_id')->nullable();
            $table->string('date_created')->nullable();
            $table->string('avatar')->nullable();
            $table->string('room_id')->nullable();
            $table->string('agent')->nullable();
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
        Schema::dropIfExists('chats');
    }
}
