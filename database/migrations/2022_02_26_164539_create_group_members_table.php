<?php

use App\Models\GroupMember;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')
                ->onDelete('cascade');
            $table->foreignId('account_requestor_id')
                ->nullable()
                ->onDelete('set null');
            $table->foreignId('account_member_id')
                ->onDelete('cascade');
            $table->timestamp('confirmed_at')
                ->nullable();
            $table->string('remarks')
                ->nullable();
            $table->string('position')
                ->nullable();
            $table->string('status')
                ->default(GroupMember::STATUS_PENDING);
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
        Schema::dropIfExists('group_members');
    }
}
