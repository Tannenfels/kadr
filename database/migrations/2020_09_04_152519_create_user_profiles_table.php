<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('country');
            $table->text('text');
            $table->string('avatar');
            $table->string('photo');
            $table->string('signature');
            $table->string('occupation');
            $table->smallInteger('timezone');
            $table->date('birthdate');
            $table->string('lang', 16);
            $table->unsignedTinyInteger('hide_email')->default(1);
            $table->unsignedTinyInteger('pm_notifications')->default(0);
            $table->unsignedTinyInteger('new_pm')->default(0);
            $table->unsignedInteger('log_count');


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
