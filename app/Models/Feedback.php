<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // allow to input
    protected $fillable = [
        'feedback_title',
        'feedback_description',
    ];


    //many to one relationship with User model
    public function user () {
        return $this->belongsTo(User::class);
    }
}
