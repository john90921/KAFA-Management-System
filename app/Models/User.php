<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // allow to input
    protected $fillable = [
        'role_id',
        'user_name',
        'user_ic',
        'email',
        'password',
        'user_gender',
        'user_contact',
        'user_verification',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // one to one relationsip with Role model
    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    // one to many relationsip with Student model
    public function childs() {
        return $this->hasMany(Student::class);
    }

    // many to one relationsip with Classroom model
    public function classteacher() {
        return $this->belongsTo(Classroom::class);
    }

    // one to many relationsip with Result model
    public function marks() {
        return $this->hasMany(Result::class, 'user_id', 'id');
    }

    // one to many relationsip with Notice model
    public function notices() {
        return $this->hasMany(Notice::class);
    }
}