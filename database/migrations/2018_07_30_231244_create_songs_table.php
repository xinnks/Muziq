<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('artist_id');
            $table->integer('audio_id');
            $table->integer('cover_art_id')->nullable();
            $table->integer('album_id')->nullable();
            $table->year('year')->nullable();
            $table->integer('genre_id')->nullable();
            $table->string('unique_id')->unique();
            $table->text('lyrics')->nullable();
            $table->timestamps();

            $table->foreign('cover_art_id')->references('id')->on('cover_arts');
            $table->foreign('artist_id')->references('id')->on('artists');
            $table->foreign('audio_id')->references('id')->on('audio');
            $table->foreign('album_id')->references('id')->on('albums');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
}
