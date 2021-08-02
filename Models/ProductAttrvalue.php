<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttrvalue extends Model
{
    use HasFactory;

    public function attrtype()
    {
        return $this->belongsTo(Attrtype::class);
    }
}
