<?php

use App\Models\Ticket;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')
                ->onDelete('set null')
                ->nullable();
            $table->foreignId('user_id')
                ->onDelete('set null')
                ->nullable();
            $table->unsignedBigInteger('model_id');
            $table->string('model_type');
            $table->string('action')->default(Ticket::ACTION_UPDATE);
            $table->longText('new_state')->nullable();
            $table->longText('old_state')->nullable();
            $table->string('status')->default(Ticket::STATUS_PENDING);
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_at_by_user_id')
                ->onDelete('set null')
                ->nullable();
            $table->text('approver_notes')->nullable();
            $table->text('requestor_notes')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
