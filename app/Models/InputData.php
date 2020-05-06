<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputData extends Model
{
    protected $table = 'input_datas';
    public $timestamps = false;
    protected $primaryKey = 'idx';
    public $incrementing = false;
}
