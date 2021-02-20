<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idAdmin');
            $table->foreignId('idParticipant');
            $table->string('content');
            $table->timestamps();
        });

        Schema::table('service', function (Blueprint $table) {
            $table->foreign('idAdmin')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('service');
    }
}
