<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public function getTypeToPersianAttribute()
    {
        $listPersianTypeBanner = [
            'index_slider' => 'اسلایدر صفحه ی اصلی',
            'index_top' => 'بنر بالای صفحه ی اصلی',
            'index_bottom' => 'بنر پایین صفحه ی اصلی',
            'index_middle' => 'بنر میانه صفحه ی اصلی',
        ];

        return $listPersianTypeBanner[$this->type];
    }
}
