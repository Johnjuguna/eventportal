<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
        'name',
        'image',
        'description',
        'location',
        'date',
        'start_time',
        'organizer',
    ];
    //
}
