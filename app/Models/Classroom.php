<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Action;

class Classroom extends Model
{
    use HasFactory;

    // allow to input
    protected $fillable = [
        'teacher_id',
        'class_name',
        'class_description',
    ];

    // one to one relationsip with User model
    public function teacher() {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }
    
    // one to many relationsip with Student model
    public function students() {
        return $this->hasMany(Student::class);
    }

    // one to many relationsip with Activity model
    public function activities() {
        return $this->hasMany(Activity::class);
    }
}
