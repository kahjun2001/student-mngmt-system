<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RemoveCourseIdFromSubjectsTable extends Migration
{
    public function up()
    {
        Schema::table('subjects', function (Blueprint $table) {
            // Check if the foreign key exists before dropping it
            $foreignKeys = DB::select("SELECT CONSTRAINT_NAME 
                                       FROM information_schema.KEY_COLUMN_USAGE 
                                       WHERE TABLE_NAME = 'subjects' 
                                       AND COLUMN_NAME = 'course_id' 
                                       AND CONSTRAINT_SCHEMA = DATABASE()");
                                       
            if (!empty($foreignKeys)) {
                $table->dropForeign(['course_id']);
            }

            // Drop the column only if it exists
            if (Schema::hasColumn('subjects', 'course_id')) {
                $table->dropColumn('course_id');
            }
        });
    }

    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            if (!Schema::hasColumn('subjects', 'course_id')) {
                $table->unsignedBigInteger('course_id')->nullable();
                $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            }
        });
    }
}