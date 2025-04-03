<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamMark extends Model
{
    use HasFactory;

    protected $fillable = ['student_custom_id', 'subject_code', 'marks',];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_custom_id', 'custom_id');
    }

    public function subject()
{
    return $this->belongsTo(Subject::class, 'subject_code', 'subject_code');
}
}
