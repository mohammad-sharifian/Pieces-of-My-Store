<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->paginate(20);

        return view('admin.banners.index')
            ->with(compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|max:50|unique:banners,name',
            'type' => 'required|in:index_slider,index_top,index_bottom,index_middle',
            'priority' => 'required|integer',
            'image' => 'required|mimes:jpg,jpeg,png,svg',
            'title' => 'nullable',
            'text' => 'nullable',
            'is_active' => 'required|in:0, 1',
            'button_text' => 'nullable',
            'button_link' => 'nullable',
            'button_icon' => 'nullable',
        ]);

        try
        {
            DB::beginTransaction();

            $banner = new Banner;
            $banner->name = $r->name;
            $banner->type = $r->type;
            $banner->priority = $r->priority;
            $banner->title = $r->title;
            $banner->is_active = $r->is_active;
            $banner->text = $r->text;
            $banner->button_text = $r->button_text;
            $banner->button_link = $r->button_link;
            $banner->button_icon = $r->button_icon;
            $banner->save();

            if($r->file('image')->isValid())
            {
                $image = $r->file('image');
                $path =$image->store("$banner->id",'banners');

                $name = explode('/', $path)[1];

                $banner->image = $name;
                $banner->save();

                // Resize For Thumbnail
                $thumbName = 'thumb_' .time(). '.' .$image->extension();

                $banner->thumbnail_image = $thumbName;
                $banner->save();

                // dd(url(env('BANNER_IMAGES_PATH')) .'/' ."{$r->type}/$banner->id/" .$thumbName);

                $img = Image::make($image->path());
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path(env('BANNER_IMAGES_PATH')) .'/' ."{$banner->id}/" .$thumbName);
            }

            DB::commit();
        }
        catch(\Exception $ex)
        {
            DB::rollBack();

            alert()->error('ایجاد بنر جدید با شکست مواجه شد', 'ناموفق!')->persistent("بستن");
        }

        alert()->success('ایجاد بنر جدید با موفقیت انجام شد.', 'باتشکر!');

        return redirect()->route('admin.banners.index');

    }

    public function show(Banner $banner)
    {
        return view('admin.banners.show')
            ->with(compact('banner'));
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit')
            ->with(compact('banner'));
    }

    public function update(Request $r, Banner $banner)
    {
        $r->validate([
            'name' => 'required|max:50|unique:banners,name,'.$banner->id,
            'type' => 'required|in:index_slider,index_top,index_bottom,index_middle',
            'priority' => 'required|integer',
            'image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'title' => 'nullable',
            'text' => 'nullable',
            'is_active' => 'required|in:0, 1',
            'button_text' => 'nullable',
            'button_link' => 'nullable',
            'button_icon' => 'nullable',
        ]);

        try
        {
            DB::beginTransaction();

            $banner->name = $r->name;
            $banner->type = $r->type;
            $banner->priority = $r->priority;
            $banner->title = $r->title;
            $banner->is_active = $r->is_active;
            $banner->text = $r->text;
            $banner->button_text = $r->button_text;
            $banner->button_link = $r->button_link;
            $banner->button_icon = $r->button_icon;
            $banner->save();

            if($r->has('image') && $r->file('image')->isValid())
            {
                if(Storage::disk('banners')->exists("{$banner->id}"))
                {
                    Storage::disk('banners')->deleteDirectory("{$banner->id}");
                }

                $image = $r->file('image');
                $path = $image->store("{$banner->id}" ,'banners');
                $name = explode('/', $path)[1];

                // Resize For Thumbnail
                $thumbName = 'thumb_' .time() . '.' .$image->extension();
                $img = Image::make($image->path());
                $img->resize(100, 100, function ($constraint){
                    $constraint->aspectRatio();
                })->save(public_path(env('BANNER_IMAGES_PATH')). "{$banner->id}/{$thumbName}");

                $banner->image = $name;
                $banner->thumbnail_image = $thumbName;
                $banner->save();
            }

            DB::commit();
        }
        catch(\Exception $ex)
        {
            DB::rollback();

            alert()->error('ویرایش بنر موردنظر با شکست مواجه شد', 'ناموفق!')->persistent("بستن");
        }

        alert()->success('بنر موردنظر با موفقیت ویرایش شد.', 'باتشکر!');

        return redirect()->route('admin.banners.show', ['banner' => $banner->id]);

    }

    public function destroy($id)
    {
        //
    }
}
