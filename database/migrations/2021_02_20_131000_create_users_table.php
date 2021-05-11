<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('status')->unsigned();
            $table->string('role');
            $table->string('phoneNumber')->nullable();
            $table->date('dob')->nullable();
            $table->string('photoProfile')->nullable();
            $table->string('backgroundPicture')->nullable();
            $table->string('linkProfile')->nullable();
            $table->string('aboutMe')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('job')->nullable();
            $table->string('gender')->nullable();
            $table->string('ktpPicture')->nullable();
            $table->string('nik')->nullable();
            $table->string('accountNumber')->nullable();
            $table->integer('countEvent')->default(0);
            $table->boolean('is_online')->default(0);
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('status')
                ->references('id')
                ->on('status_user')
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
        Schema::dropIfExists('users');
    }
}
