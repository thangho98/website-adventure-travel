<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = 'promotion';
    protected $primaryKey = 'prom_id';
    protected $guarded = [];
}