<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['subject_code','name'];
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subject', 'subject_code', 'student_custom_id');
    }

    public function examMarks()
    {
        return $this->hasMany(ExamMark::class, 'subject_code', 'subject_code');
    }

}
