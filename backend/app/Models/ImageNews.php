<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageNews extends Model
{
    protected $table = 'image_news';
    protected $primaryKey = 'in_id';
    protected $guarded = [];
}