<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refill extends Model
{
    use HasFactory;
    protected $fillable = [
        'uid',
        'username',
        'amount',
        'img',
    ];
}