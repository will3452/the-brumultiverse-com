<?php

use App\Models\StudentPackage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_packages', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default(StudentPackage::DEFAULT_TYPE);
            $table->string('name')->nullable();
            $table->string('picture')->nullable();
            $table->string('cost');
            $table->string('content');
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
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
        Schema::dropIfExists('student_packages');
    }
}
