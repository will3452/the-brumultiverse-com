<?php

use App\Helpers\CrystalHelper;
use App\Models\Book;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('user_id')
                ->onDelete('set null')
                ->nullable();
            $table->string('title');
            $table->string('age_restriction')->nullable();
            $table->boolean('has_warning_message')->default(false);
            $table->foreignId('category_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('language_id')
                ->onDelete('set null')
                ->nullable();
            $table->longText('credit')->nullable();
            $table->longText('blurb')->nullable();
            $table->foreignId('genre_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('heat_level_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('violence_level_id')
                ->onDelete('set null')
                ->nullable();
            $table->string('type')->default(Book::TYPE_REGULAR);
            $table->string('cost')->nullable();
            $table->string('cost_type')->default(CrystalHelper::PURPLE_CRYSTAL);
            $table->string('lead_character');
            $table->string('lead_college');
            $table->timestamp('published_at')->nullable();
            $table->string('back_matter')->nullable();
            $table->string('front_matter')->nullable();
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
        Schema::dropIfExists('books');
    }
}
