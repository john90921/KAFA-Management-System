<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    // allow to input
    protected $fillable = [
        'exam_type',
        'school_session',
        'approval_status',
        'exam_comment',
    ];

    // one to many relationsip with Result model
    public function results() {
        return $this->hasMany(Result::class);
    }
}
