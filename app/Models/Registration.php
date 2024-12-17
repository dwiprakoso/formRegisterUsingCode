<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;

    // Kolom yang diperbolehkan untuk mass assignment
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'unique_code',
    ];
}
