<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_name',
        'name',
        'phone_number',
        'profile_image',
        'events',
        'groups',
        'dob',
    ];

}
