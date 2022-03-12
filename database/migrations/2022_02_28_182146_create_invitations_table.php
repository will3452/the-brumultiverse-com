<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('model_type');
            $table->foreignId('model_id')
                ->onDelete('cascade');
            $table->string('title');
            $table->longText('body');
            $table->string('type')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->string('answer')->nullable();
            $table->timestamp('answered_at')->nullable();
            $table->foreignId('user_id')
                ->onDelete('cascade');
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
        Schema::dropIfExists('invitations');
    }
}
