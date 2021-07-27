<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attrtype;
use Attribute;
use Illuminate\Http\Request;

class AttrtypeController extends Controller
{

    public function index()
    {
        $attrtypes = Attrtype::latest()->paginate(20);

        return view('admin.attrtypes.index')
            ->with(compact('attrtypes'));
    }


    public function create()
    {
        return view('admin.attrtypes.create');
    }


    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|max:50',
        ]);

        $attrtype = new Attrtype;
        $attrtype->name = $r->name;
        $attrtype->save();

        alert()->success('ویژگی جدید با موفقیت ایجاد شد.', 'باتشکر!');

        return redirect()->route('admin.attrtypes.index');
    }


    public function show(Attrtype $attrtype)
    {
        return view('admin.attrtypes.show')
            ->with(compact('attrtype'));
    }


    public function edit(Attrtype $attrtype)
    {
        return view('admin.attrtypes.edit')
            ->with(compact('attrtype'));
    }


    public function update(Request $r, Attrtype $attrtype)
    {
        $r->validate([
            'name' => 'required|max:50'
        ]);

        $attrtype->name= $r->name;
        $attrtype->save();

        alert()->success('ویژگی با موفقیت ویرایش شد.', 'باتشکر!');

        return redirect()->route('admin.attrtypes.index');
    }


    public function destroy($id)
    {
        //
    }
}
