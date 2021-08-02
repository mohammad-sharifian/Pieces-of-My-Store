<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attrtype extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'attrtype_category','attrtype_id','category_id')
            ->withTimestamps();
    }
}
