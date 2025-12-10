<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    // allow to input
    protected $fillable = [
        'student_id',
        'user_id',
        'subject_id',
        'examination_id',
        'result_marks',
        'result_feedback',
        'result_grades',
        'result_status',
        'result_subject',
    ];

    // many to one relationsip with Student model
    public function studentresult() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    // many to one relationsip with User model
    public function markbyteacher() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // many to one relationsip with Examination model
    public function examination() {
        return $this->belongsTo(Examination::class);
    }

    // many to one relationsip with Subject model
    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}
