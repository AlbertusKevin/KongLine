<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPetition');
            $table->longText('content');
            $table->string('link');
            $table->string('title');
            $table->timestamps();
        });

        Schema::table('update_news', function (Blueprint $table) {
            $table->foreign('idPetition')
                ->references('id')
                ->on('petition')
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
        Schema::dropIfExists('update_news');
    }
}
