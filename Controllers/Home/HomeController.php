<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::with('children')->where('parent_id','0')->get();

        return view('home.index.index')
            ->with(compact('categories'));
    }


    public function create()
    {
        //
    }


    public function store(Request $r)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $r, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
