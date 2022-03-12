<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 32);
            $table->string('last_name', 32);
            $table->string('middle_name', 32)->nullable();
            $table->string('user_name', 32);
            $table->string('gender', 7);
            $table->datetime('birth_date');
            $table->string('sex', 7);
            $table->string('address', 120)->nullable();
            $table->string('country', 32);
            $table->string('city', 32)->nullable();
            $table->string('picture')->nullable();
            $table->string('account_type')->default(User::ACCOUNT_FREE);
            $table->string('role')->default(USER::ROLE_NORMAL);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
