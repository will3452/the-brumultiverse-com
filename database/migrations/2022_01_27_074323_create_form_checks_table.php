<?php

use App\Models\FormCheck;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_checks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file');
            $table->string('description');
            $table->string('type')->default(FormCheck::TYPE_OPTIONAL);
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
        Schema::dropIfExists('form_checks');
    }
}
