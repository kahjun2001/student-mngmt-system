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
        Schema::table('student_subject', function (Blueprint $table) {
            $table->string('student_custom_id')->after('id');
            $table->string('subject_code')->after('student_custom_id');

            // Add foreign keys
            $table->foreign('student_custom_id')->references('custom_id')->on('students')->onDelete('cascade');
            $table->foreign('subject_code')->references('code')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_subject', function (Blueprint $table) {
            $table->dropForeign(['student_custom_id']);
            $table->dropForeign(['subject_code']);
            $table->dropColumn(['student_custom_id', 'subject_code']);
        });
    }
};
