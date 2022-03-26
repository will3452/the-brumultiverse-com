<?php

use App\Helpers\MarketingHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadingImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loading_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->onDelete('cascade');
            $table->foreignId('package_id')
                ->onDelete('cascade');
            $table->date('scheduled_at');
            $table->string('status')->default(MarketingHelper::STATUS_DRAFT);
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
        Schema::dropIfExists('loading_images');
    }
}
