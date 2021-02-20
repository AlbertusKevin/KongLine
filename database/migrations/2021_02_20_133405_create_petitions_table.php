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
            $table->tinyInteger('category')->unsigned();
            $table->date('deadline');
            $table->foreignId('idCampaigner');
            $table->string('photo');
            $table->string('purpose');
            $table->tinyInteger('status')->unsigned();
            $table->string('title')->unique();
            $table->string('targetPerson');
            $table->integer('signedCollected');
            $table->integer('signedTarget');
            $table->timestamps();
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
