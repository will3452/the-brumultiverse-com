<?php

use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->onDelete('set null');
            $table->foreignId('model_id')
                ->nullable()
                ->onDelete('set null');
            $table->string('model_type')
                ->nullable();
            $table->string('txnid');
            $table->string('amount');
            $table->text('description');
            $table->string('message')
                ->nullable();
            $table->string('ref_no')
                ->nullable();
            $table->string('status')
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
        Schema::dropIfExists('payment_transactions');
    }
}
