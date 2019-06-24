<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TouristRoute extends Model
{
    protected $table = 'tourist_routes';
    protected $primaryKey = 'tr_id';
    protected $guarded = [];
}