<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    // allow to input
    protected $fillable = [
        'user_id',
        'notice_title',
        'notice_text',
        'notice_poster',
        'notice_submission_date',
        'notice_status',
    ];

    // many to one relationsip with User model
    public function user() {
        return $this->belongsTo(User::class);
    }
}
