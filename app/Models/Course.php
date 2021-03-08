<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Teacher;

class Course extends Model
{
    use HasFactory;
    protected $fillable=[
        'course_name',
        'teacher_id',
        'credit_hours'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    // public function teacher()
    // {
    //     return $this->belongsToMany(Teacher::class);
    // }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
