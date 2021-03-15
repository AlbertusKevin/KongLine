<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->foreignId('idDonation');
            $table->foreignId('idParticipant');
            $table->string('accountNumber');
            $table->string('bank');
            $table->integer('nominal');
            $table->string('repaymentPicture');
            $table->tinyInteger('status')->unsigned();
            $table->date('created_at');
        });

        Schema::table('transaction', function (Blueprint $table) {
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
        Schema::dropIfExists('transaction');
    }
}
