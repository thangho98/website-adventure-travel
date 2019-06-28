<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteTour extends Model
{
    protected $table = 'favorite_tours';
    protected $primaryKey = 'fa_id';
    protected $guarded = [];
}