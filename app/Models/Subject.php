<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_name',
        'subject_description',
    ];

    public function activities() {
        return $this->hasMany(Activity::class);
    }

    public function results() {
        return $this->hasMany(Result::class);
    }
}
