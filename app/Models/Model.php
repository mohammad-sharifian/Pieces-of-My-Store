<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as M;
use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends M
{
    use HasFactory, SoftDeletes;

    protected $guarded =[];

    public function creator ()
    {
        $this->belongsTo(User::class,'creator_id');
    }
}
