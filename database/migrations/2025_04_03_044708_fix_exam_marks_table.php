<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('exam_marks', function (Blueprint $table) {
            $table->dropColumn('subject');
            $table->foreignId('subject_id')->after('student_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('exam_marks', function (Blueprint $table) {
            $table->string('subject')->after('student_id');
            $table->dropColumn('subject_id');
        });
    }
};
