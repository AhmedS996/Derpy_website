<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'admin_id',
        'name',
        'description',
        'group_image',
        'catagory', // corrected spelling of category
        'location',
        'access_modifier',
        'members',
        'events',
    ];
}
