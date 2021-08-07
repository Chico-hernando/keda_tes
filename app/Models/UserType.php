<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $table = 'user_types';
}
