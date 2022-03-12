<?php

use App\Models\Album;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default(Album::TYPE_SONG);
            $table->longText('description');
            $table->longText('credit');
            $table->timestamp('published_at')
                ->nullable();
            $table->foreignId('user_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('account_id')
                ->onDelete('set null')
                ->nullable();
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
        Schema::dropIfExists('albums');
    }
}
