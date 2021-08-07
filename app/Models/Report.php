<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $table = 'report';
}
