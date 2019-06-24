<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserClient extends Model
{
    protected $table = 'user_clients';
    protected $primaryKey = 'user_id';
    protected $guarded = [];
}