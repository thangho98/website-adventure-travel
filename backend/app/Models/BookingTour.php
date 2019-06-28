<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingTour extends Model
{
    protected $table = 'booking_tours';
    protected $primaryKey = 'bt_id';
    protected $guarded = [];
}