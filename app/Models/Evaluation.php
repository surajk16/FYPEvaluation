<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';
    public $timestamps = false;
    protected $primaryKey = 'idx';
    public $incrementing = false;
}
