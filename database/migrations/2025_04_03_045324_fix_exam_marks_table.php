<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('exam_marks', function (Blueprint $table) {
            $table->dropColumn('student_id');
            $table->dropColumn('subject');

            $table->string('student_custom_id')->after('id');
            $table->string('subject_code')->after('student_custom_id');
        });
    }

    public function down()
    {
        Schema::table('exam_marks', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->after('id');
            $table->string('subject')->after('student_id');
            $table->dropColumn('student_custom_id');
            $table->dropColumn('subject_code');
        });
    }
};
