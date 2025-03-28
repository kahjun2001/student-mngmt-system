<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamMark extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'subject', 'marks']; // Ensure 'subject' is listed

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
