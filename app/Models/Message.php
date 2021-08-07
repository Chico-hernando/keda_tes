<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $table = 'message';
}
