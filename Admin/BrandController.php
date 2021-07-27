<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::latest()->paginate(20);


        return view('admin.brands.index')
            ->with(compact('brands'));
    }


    public function create()
    {
        return view('admin.brands.create');
    }


    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|max:50',
            'is_active' => 'required|in:0,1',
        ]);

        $brand = new Brand;

        $brand->name = $r->name;
        $brand->is_active = $r->is_active;
        $brand->save();

        alert()->success('برند جدید با موفقیت ایجاد شد.', 'باتشکر!');

        return redirect()->route('admin.brands.index');
    }


    public function show(Brand $brand)
    {
        return view('admin.brands.show')
            ->with(compact('brand'));
    }


    public function edit(Brand $brand)
    {
        return view('admin.brands.edit')
            ->with(compact('brand'));
    }


    public function update(Request $r, Brand $brand)
    {
        $r->validate([
            'name' => 'required|max:50',
            'is_active' => 'required|in:0,1',
        ]);

        $brand->name= $r->name;
        $brand->is_active= $r->is_active;
        $brand->save();

        alert()->success('برند با موفقیت ویرایش شد.', 'باتشکر!');

        return redirect()->route('admin.brands.show' ,['brand' => $brand->id]);

    }


    public function destroy($id)
    {
        //
    }
}
