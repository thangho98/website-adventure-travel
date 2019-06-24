<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'promotion';
    protected $primaryKey = 'prom_id';
    protected $guarded = [];
}