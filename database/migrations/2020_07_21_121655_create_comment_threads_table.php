<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('article_id')->nullable(false);
            $table->unsignedBigInteger('user_id');
            $table->string('author_ip');
            $table->text('text');
            $table->timestamps();
        });

        Schema::table('comment_threads', function (Blueprint $table) {
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('thread_id')->nullable(false);
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('thread_id')->references('id')->on('comment_threads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_threads');
    }
}
