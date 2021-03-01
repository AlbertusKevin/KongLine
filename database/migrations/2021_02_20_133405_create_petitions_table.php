<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petition', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->foreignId('idCampaigner');
            $table->string('photo');
            $table->longText('purpose');
            $table->string('targetPerson');
            $table->integer('signedTarget');
            $table->integer('signedCollected');
            $table->tinyInteger('category')->unsigned();
            $table->tinyInteger('status')->unsigned();
            $table->date('deadline');
            $table->date('created_at');
        });

        Schema::table('petition', function (Blueprint $table) {
            $table->foreign('category')
                ->references('id')
                ->on('category')
                ->onDelete('cascade');

            $table->foreign('status')
                ->references('id')
                ->on('event_status')
                ->onDelete('cascade');

            $table->foreign('idCampaigner')
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
        Schema::dropIfExists('petition');
    }
}
