<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participate_donation', function (Blueprint $table) {
            $table->foreignId('idDonation');
            $table->foreignId('idParticipant');
            $table->string('comment')->nullable();
            $table->date('created_at');
        });

        Schema::table('participate_donation', function (Blueprint $table) {
            $table->primary(['idDonation', 'idParticipant']);
            $table->foreign('idDonation')
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
        Schema::dropIfExists('participate_donation');
    }
}
