<?php

use App\Models\Podcast;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePodcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('user_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('account_id')
                ->onDelete('set null')
                ->nullable();
            $table->longText('description')
                ->nullable();
            $table->longText('credit')
                ->nullable();
            $table->string('type')
                ->default(Podcast::TYPE_REGULAR);
            $table->string('cost')
                ->nullable();
            $table->string('cost_type')
                ->nullable();
            $table->timestamp('launch_at')
                ->nullable();
            $table->timestamp('published_at')
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
        Schema::dropIfExists('podcasts');
    }
}
