<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'admin_id',
        'event_avatar',
        'name',
        'description',
        'category',
        'date',
        'time_start',
        'time_end',
        'location',
        'members',
        'number_of_members',
        'price',
        'cancel_event',
    ];

}
