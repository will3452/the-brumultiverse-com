<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtScenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('art_scenes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->foreignId('account_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('user_id')
                ->onDelete('set null')
                ->nullable();
            $table->string('lead_college')
                ->nullable();
            $table->foreignId('genre_id')
                ->onDelete('set null')
                ->nullable();
            $table->string('cost')->nullable();
            $table->string('cost_type')->nullable();
            $table->string('age_restriction')->nullable();
            $table->longText('credit')->nullable();
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
        Schema::dropIfExists('art_scenes');
    }
}
