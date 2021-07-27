<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attrtype;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->paginate(20);

        return view('admin.categories.index')
            ->with(compact('categories'));
    }


    public function create()
    {
        $parentCats = Category::with('children')->where('parent_id',0)->get();
        $attrtypes = Attrtype::all();

        return view('admin.categories.create')
            ->with(compact('parentCats','attrtypes'));
    }


    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|max:50',
            'slug' => 'required|max:55,unique:categories,slug',
            'parent_id' => 'required',
            'is_active' => 'required|in:0,1',
            'attrtype_ids' => 'required|array',
            'attrtype_ids.*' => 'exists:attrtypes,id',
            'is_filter_ids' => 'required|array',
            'is_filter_ids.*' => 'exists:attrtypes,id',
            'is_variation_id' => 'required|exists:attrtypes,id',
            'icon' => 'nullable|max:50',
            'description' => 'nullable',
        ]);

        try {
            DB::beginTransaction();

            $category = new Category;
            $category->name = $r->name;
            $category->slug = $r->slug;
            $category->parent_id = $r->parent_id;
            $category->is_active = $r->is_active;
            $category->icon = $r->icon;
            $category->description = $r->description;
            $category->save();

            foreach($r->attrtype_ids as $att_id){

                $category->attrtypes()->attach($att_id, [
                    'is_filter' => in_array($att_id,$r->is_filter_ids) ? '1' : '0',
                    'is_variation' => ($att_id == $r->is_variation_id) ? '1' : '0'
                ]);
            }

            DB::commit();
        }
        catch (\Exception $er){

            DB::rollback();

            alert()->error('ایجاد دسته بندی با شکست مواجه شد', 'ناموفق!');

            return redirect()->back();
        }

        alert()->success('دسته بندی جدید با موفقیت ایجاد شد.', 'باتشکر!');

        return redirect()->route('admin.categories.index');
    }


    public function show(Category $category)
    {
        $attrtypes = $category->attrtypes;
        $is_filterAttrs = $category->attrtypes()->wherePivot('is_filter','1')->get();
        $is_variationAttr = $category->attrtypes()->wherePivot('is_variation','1')->get();

        return view('admin.categories.show')
            ->with(compact('category','attrtypes','is_filterAttrs','is_variationAttr'));

    }

    public function edit(Category $category)
    {
        $parentCats = Category::with('children')->where('parent_id',0)->get();
        $attrtypes = Attrtype::all();

        return view('admin.categories.edit')
            ->with(compact('category','parentCats', 'attrtypes'));
    }


    public function update(Request $r, Category $category)
    {
        $r->validate([
            'name' => 'required|max:50',
            'slug' => 'required|max:55|unique:categories,slug,'.$category->id,
            'parent_id' => 'required',
            'is_active' => 'required|in:0,1',
            'attrtype_ids' => 'required|array',
            'attrtype_ids.*' => 'exists:attrtypes,id',
            'is_filter_ids' => 'required|array',
            'is_filter_ids.*' => 'exists:attrtypes,id',
            'is_variation_id' => 'required|exists:attrtypes,id',
            'icon' => 'nullable|max:55',
            'description' => 'nullable',
        ]);

        try {
            DB::beginTransaction();

                $category->name = $r->name;
                $category->slug = $r->slug;
                $category->parent_id = $r->parent_id;
                $category->is_active = $r->is_active;
                $category->icon = $r->icon;
                $category->description = $r->description;
                $category->save();

                $category->attrtypes()->detach();

                foreach($r->attrtype_ids as $att_id){

                    $category->attrtypes()->attach($att_id, [
                        'is_filter' => in_array($att_id,$r->is_filter_ids) ? '1' : '0',
                        'is_variation' => ($att_id == $r->is_variation_id) ? '1' : '0'
                    ]);
                }

                DB::commit();
        }
        catch (\Exception $er){

            DB::rollback();

            alert()->error('ویرایش دسته بندی با شکست مواجه شد', 'ناموفق!');

            return redirect()->back();
        }

        alert()->success('ویرایش دسته بندی با موفقیت انجام شد.', 'باتشکر!');

        return redirect()->route('admin.categories.show', ['category' => $category]);
    }


    public function destroy($id)
    {
        //
    }

    public function getCategoryAttrtypes(Category $category)
    {
        $attrtypes = $category->attrtypes()->wherePivot('is_variation', '0')->get();
        $varitype = $category->attrtypes()->wherePivot('is_variation', '1')->first();

        return ['attrtypes' => $attrtypes, 'varitype' => $varitype];
    }

    public function getCategoryProducts ($category)
    {
        if($category == 'all')
        {
            $products = Product::latest()->paginate(20);
            $categories = Category::has('products', '!=', 0)->get();

            return view('admin.products.index')
                ->with(compact('products', 'categories'));
        }
        else
        {
            $cat = Category::find($category);
            $catProducts = $cat->products()->latest()->paginate(20);
            $categories = Category::has('products', '!=', 0)->get();

            return view('admin.products.index_category')
                ->with(compact('catProducts', 'categories'))
                ->with('catListId', $category);
        }
    }
}
