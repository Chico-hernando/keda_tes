<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory,Notifiable, HasApiTokens;

    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'user_type_id','email','password','created_at','updated_at','deleted_at'
    ];

    protected $table = 'users';
    protected $hidden = ['password'];
}
