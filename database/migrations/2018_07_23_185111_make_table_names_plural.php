<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeTableNamesPlural extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('follow', 'follows');
        Schema::rename('tweet', 'tweets');
        Schema::rename('tweet_comment', 'tweet_comments');
        Schema::rename('tweet_like', 'tweet_likes');
        Schema::rename('mention', 'mentions');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('follows', 'follow');
        Schema::rename('tweets', 'tweet');
        Schema::rename('tweet_comments', 'tweet_comment');
        Schema::rename('tweet_likes', 'tweet_like');
        Schema::rename('mentions', 'mention');
    }
}
