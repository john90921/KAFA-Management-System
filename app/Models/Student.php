<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // allow to input
    protected $fillable = [
        'classroom_id',
        'parent_id',
        'student_name',
        'student_ic',
        'student_age',
        'student_gender',
        'student_verification',
    ];

    // many to one relationsip with Classroom model
    public function classroom() {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }

    // many to one relationsip with User model
    public function parent() {
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }

    // one to many relationsip with Result model
    public function results() {
        return $this->hasMany(Result::class);
    }
}