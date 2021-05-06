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
            $table->id();
            $table->foreignId('idDonation');
            $table->foreignId('idParticipant');
            $table->string('accountNumber');
            $table->integer('nominal');
            $table->string('repaymentPicture')->nullable();
            $table->tinyInteger('status')->unsigned();
            $table->boolean('annonymous_donate');
            $table->longText('reason')->nullable();
            $table->timestamps();
        });

        Schema::table('transaction', function (Blueprint $table) {
            $table->foreign('idDonation')
                ->references('id')
                ->on('donation')
                ->onDelete('cascade');
            $table->foreign('idParticipant')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('status')
                ->references('id')
                ->on('transaction_status')
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
