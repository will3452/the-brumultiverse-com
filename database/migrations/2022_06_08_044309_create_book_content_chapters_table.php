<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookContentChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_content_chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')
                ->constrained('books', 'id')
                ->cascadeOnDelete();
            $table->foreignId('book_content_id')
                ->constrained('book_contents', 'id')
                ->cascadeOnDelete();
            $table->string('age_restriction')
                ->nullable();
            $table->string('type')->nullable();
            $table->string('start_page')->nullable();
            $table->string('end_page')->nullable();
            $table->string('cost')->nullable();
            $table->string('cost_type')->nullable();
            $table->longText('authors_note')->nullable();
            $table->longText('description')->nullable();
            $table->string('sq')->nullable();
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
        Schema::dropIfExists('book_content_chapters');
    }
}
