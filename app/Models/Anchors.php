<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anchors extends Model
{
    protected $table = 'anchors';
    public $timestamps = false;
    protected $primaryKey = 'idx';
    public $incrementing = false;
}
