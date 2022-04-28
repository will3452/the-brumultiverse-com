<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mediable_id');
            $table->string('mediable_type');
            $table->string('path');
            $table->string('type')->nullable(); // .mp3, .mp4,
            $table->boolean('copyright_disclaimer')->default(false);
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
        Schema::dropIfExists('previews');
    }
}
