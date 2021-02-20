<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_allocation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idDonation');
            $table->bigInteger('nominal');
            $table->string('description');
        });

        Schema::table('detail_allocation', function (Blueprint $table) {
            $table->foreign('idDonation')
                ->references('id')
                ->on('donation')
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
        Schema::dropIfExists('detail_allocation');
    }
}
