<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('viewAny')
                ->nullable();
            $table->string('view')
                ->nullable();
            $table->string('create')
                ->nullable();
            $table->string('delete')
                ->nullable();
            $table->string('update')
                ->nullable();
            $table->string('restore')
                ->nullable();
            $table->string('forceDelete')
                ->nullable();
            $table->string('name')
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
        Schema::dropIfExists('policies');
    }
}
