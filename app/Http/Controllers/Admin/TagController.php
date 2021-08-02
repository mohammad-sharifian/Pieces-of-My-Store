<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::latest()->paginate(20);

        return view('admin.tags.index')
            ->with(compact('tags'));
    }


    public function create()
    {
        return view('admin.tags.create');
    }


    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|max:50',
        ]);

        $tag = new Tag;
        $tag->name = $r->name;
        $tag->save();

        alert()->success('برچسب جدید با موفقیت ایجاد شد.', 'باتشکر!');

        return redirect()->route('admin.tags.index');
    }


    public function show(Tag $tag)
    {
        return view('admin.tags.show')
            ->with(compact('tag'));
    }


    public function edit(Tag $tag)
    {
        return view('admin.tags.edit')
            ->with(compact('tag'));
    }


    public function update(Request $r, Tag $tag)
    {
        $r->validate([
            'name' => 'required|max:50'
        ]);

        $tag->name= $r->name;
        $tag->save();

        alert()->success('برچسب با موفقیت ویرایش شد.', 'باتشکر!');

        return redirect()->route('admin.tags.index');
    }


    public function destroy($id)
    {
        //
    }
}
