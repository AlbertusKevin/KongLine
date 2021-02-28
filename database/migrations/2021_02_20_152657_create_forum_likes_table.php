<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_like', function (Blueprint $table) {
            $table->foreignId('idForum');
            $table->foreignId('idParticipant');
            $table->date('created_at');
        });

        Schema::table('forum_like', function (Blueprint $table) {
            $table->primary(['idForum', 'idParticipant']);
            $table->foreign('idForum')
                ->references('id')
                ->on('forum')
                ->onDelete('cascade');
            $table->foreign('idParticipant')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('forum_like');
    }
}
