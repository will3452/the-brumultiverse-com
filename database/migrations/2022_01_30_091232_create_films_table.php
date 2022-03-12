<?php

use App\Models\Film;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default(Film::TYPE_TRAILER);
            $table->string('age_restriction')->nullable();
            $table->foreignId('genre_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('language_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('user_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('account_id')
                ->onDelete('set null')
                ->nullable();
            $table->string('cost_type')
                ->nullable();
            $table->string('cost')
                ->nullable();
            $table->longText('credit')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('films');
    }
}
