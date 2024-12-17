<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quota'];

    public function uniqueCodes()
    {
        return $this->hasMany(UniqueCode::class, 'category_id', 'id');
    }
}
