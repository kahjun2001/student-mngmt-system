<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('exam_marks', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->after('id'); // Foreign key
            $table->string('subject')->after('student_id'); // Subject name
            $table->integer('marks')->after('subject'); // Exam score
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_marks', function (Blueprint $table) {
            $table->dropColumn(['student_id', 'subject', 'marks']);
        });
    }
};
