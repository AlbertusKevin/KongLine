<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_forum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idForum');
            $table->foreignId('idParticipant');
            $table->longText('content');
            $table->date('created_at');
        });

        Schema::table('comment_forum', function (Blueprint $table) {
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
        Schema::dropIfExists('comment_forum');
    }
}
