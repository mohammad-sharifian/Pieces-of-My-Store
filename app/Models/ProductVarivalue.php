<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVarivalue extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function attrtype()
    {
        return $this->belongsTo(Attrtype::class);
    }
}
