<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['custom_id','name','email','phone','dob','course_id'];

    public function examMarks()
    {
        return $this->hasMany(ExamMark::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subjects()
    {
    return $this->belongsToMany(Subject::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
            $year = date('y');
            $month = date('m');

            $count = self::whereRaw('YEAR(created_at) = ? AND MONTH(created_at) = ?', [date('Y'), date('m')])
                ->count() + 1;

            $student->custom_id = $year . $month . str_pad($count, 4, '0', STR_PAD_LEFT);
        });

        // Increment total_students when a student is created
        static::created(function ($student) {
            if ($student->course) {
                $student->course->increment('total_students');
            }
        });

        // Decrement total_students when a student is deleted
        static::deleted(function ($student) {
            if ($student->course) {
                $student->course->decrement('total_students');
            }
        });
    }
}