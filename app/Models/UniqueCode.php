<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UniqueCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'category_id', 'is_used'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
