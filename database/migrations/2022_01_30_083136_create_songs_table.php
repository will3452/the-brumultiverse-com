<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('title');
            $table->foreignId('user_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('account_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('genre_id')
                ->onDelete('set null')
                ->nullable();
            $table->longText('description')->nullable();
            $table->longText('credit')->nullable();
            $table->string('cost_type')->nullable();
            $table->string('cost')->nullable();
            $table->longText('lyrics')->nullable();
            $table->longText('copyright')->nullable();
            $table->boolean('not_yet_copyrighted')->default(true);
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('songs');
    }
}
