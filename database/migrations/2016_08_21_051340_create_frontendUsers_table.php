<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontendUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontend_users', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('course');
            $table->string('college');
            $table->string('mobileNumber');
            $table->string('id_image_front');
            $table->string('id_image_back');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('frontend_users');
    }
}
