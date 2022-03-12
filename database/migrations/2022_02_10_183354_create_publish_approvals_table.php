<?php

use App\Models\PublishApproval;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publish_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->onDelete('cascade');
            $table->foreignId('account_id')
                ->onDelete('cascade');
            $table->string('model_type');
            $table->bigInteger('model_id');
            $table->longText('notes');
            $table->text('status')->default(PublishApproval::STATUS_PENDING);
            $table->foreignId('approved_by_user_id')
                ->nullable()
                ->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
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
        Schema::dropIfExists('publish_approvals');
    }
}
