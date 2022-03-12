<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeArtScenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_art_scenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('art_scene_id')
                ->onDelete('cascade');
            $table->foreignId('model_id')
                ->onDelete('cascade');
            $table->string('model_type');
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
        Schema::dropIfExists('free_art_scenes');
    }
}
