<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipatePetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participate_petition', function (Blueprint $table) {
            $table->foreignId('idPetition');
            $table->foreignId('idParticipant');
            $table->string('comment');
            $table->timestamps();
        });

        Schema::table('participate_petition', function (Blueprint $table) {
            $table->primary(['idPetition', 'idParticipant']);
            $table->foreign('idPetition')
                ->references('id')
                ->on('donation')
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
        Schema::dropIfExists('participate_petition');
    }
}
