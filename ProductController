<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductAttrvalue;
use App\Models\ProductVarivalue;
use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index(Request $r)
    {
        $products = Product::latest()->paginate(20);
        $categories = Category::has('products', '!=', 0)->get();

        return view('admin.products.index')
            ->with(compact('products', 'categories'));
    }


    public function create()
    {
        $tags = Tag::all();
        $brands = Brand::all();
        $categories = Category::all();

        return view('admin.products.create')
            ->with(compact('tags', 'categories', 'brands'));
    }


    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|max:70',
            'brand_id' => 'required|exists:brands,id',
            'is_active' => 'required|in:0,1',
            'tag_ids' => 'required|array',
            'tag_ids.*' => 'exists:tags,id',
            'description' => 'nullable',
            'primary_image' => 'required|mimes:jpg,jpeg,png',
            'images' => 'required|array|min:1',
            'images.*' => 'mimes:jpg,jpeg,png',
            'category_id' => 'exists:categories,id',
            'attrvalues' => 'required|array',
            'attrvalues.*' => 'nullable',
            'varivalues' => 'required|array',
            'varivalues.price.*' => 'required|integer',
            'varivalues.count.*' => 'required|integer',
            'varivalues.sku.*' => 'nullable',
            'delivery_amount' => 'nullable|integer',
            'delivery_amount_per_product' => 'nullable|integer'
        ]);

        try{
            DB::beginTransaction();

            $product = new Product;
            $product->name = $r->name;
            $product->is_active = $r->is_active;
            $product->brand_id = $r->brand_id;
            $product->category_id = $r->category_id;
            $product->primary_image = null;
            $product->description = $r->description;
            $product->delivery_amount = $r->delivery_amount;
            $product->delivery_amount_per_product = $r->delivery_amount_per_product;
            $product->save();

            $productImageController = new ProductImageController();
            $productImageController->store($r, $product ,$widthThumb=100, $heightThumb=100, $widthPrimary=400, $heightPrimary=400);

            $productAttrvalueController = new ProductAttrvalueController();
            $productAttrvalueController->store($r,$product);

            $productVarivalueController = new ProductVarivalueController();
            $productVarivalueController->store($r,$product);

            $product->tags()->attach($r->tag_ids);

            DB::commit();
        }
        catch(\Exception $ex){

            DB::roolback();

            alert()->error('ایجاد کالای جدید با شکست مواجه شد', 'ناموفق!')->persistent("بستن");
        }

        alert()->success('ایجاد کالای جدید با موفقیت انجام شد.', 'باتشکر!');

        return redirect()->route('admin.products.index');
    }


    public function show(Request $r ,Product $product)
    {
        $attributes = $product->productAttrvalues->load('attrtype');
        $variations = $product->productVarivalues->load('attrtype');
        $images = $product->productImages;

        return view('admin.products.show')
            ->with(compact('product', 'attributes', 'variations', 'images'))
            ->with('catListId', $r->catListId);
    }


    public function edit(Product $product)
    {
        $brands = Brand::all();
        $tags = Tag::all();
        $productTagIds = $product->tags->pluck('id')->toArray();
        $productAttrValues = $product->productAttrvalues->load('attrtype');
        $productVariations = $product->productVarivalues->load('attrtype');

        return view('admin.products.edit')
         ->with(compact('product', 'brands', 'tags', 'productTagIds', 'productAttrValues', 'productVariations'));
    }


    public function update(Request $r, Product $product)
    {
        $r->validate([
            'name' => 'required|max:70',
            'brand_id' => 'required|exists:brands,id',
            'is_active' => 'required|in:0,1',
            'tag_ids' => 'required|array',
            'tag_ids.*' => 'exists:tags,id',
            'description' => 'nullable',
            // 'primary_image' => 'required|mimes:jpg,jpeg,png',
            // 'images' => 'required|array|min:1',
            // 'images.*' => 'mimes:jpg,jpeg,png',
            // 'category_id' => 'exists:categories,id',
            'attrvalues' => 'required|array',
            'attrvalues.*' => 'required',
            'varivalues' => 'required|array',
            'varivalues.*.price' => 'required|integer',
            'varivalues.*.count' => 'required|integer',
            'varivalues.*.sku' => 'nullable',
            'varivalues.*.sale_price' => 'nullable',
            'varivalues.*.date_on_sale_from' => 'nullable',
            'varivalues.*.date_on_sale_to' => 'nullable',
            'delivery_amount' => 'nullable|integer',
            'delivery_amount_per_product' => 'nullable|integer'
        ]);

        try
        {
            DB::beginTransaction();

            $product->name = $r->name;
            $product->brand_id = $r->brand_id;
            $product->is_active = $r->is_active;
            $product->description = $r->description;
            $product->delivery_amount = $r->delivery_amount;
            $product->delivery_amount_per_product = $r->delivery_amount_per_product;
            $product->save();

            $product->tags()->detach();
            $product->tags()->attach($r->tag_ids);

            $productAttrvalueController =  new ProductAttrvalueController();
            $productAttrvalueController->update($r, $product);

            $productVarivalueController = new ProductVarivalueController();
            $productVarivalueController->update($r, $product);

            DB::commit();
        }
        catch(\Exception $ex)
        {
            DB::rollback();

            alert()->error('ویرایش کالای موردنظر با شکست مواجه شد', 'ناموفق!')->persistent("بستن");
        }

        alert()->success('کالای موردنظر با موفقیت ویرایش شد.', 'باتشکر!');

        return redirect()->route('admin.products.show', ['product' => $product->id]);

    }


    public function destroy($id)
    {
        //
    }

    public function editCategory(Product $product)
    {
        $categories = Category::all();

        $productCategoryId = $product->category->id;

        return view('admin.products.edit_category')
            ->with(compact('product' ,'categories', 'productCategoryId'));
    }

    public function updateCategory(Request $r ,Product $product)
    {
        $r->validate([
            'category_id' => 'exists:categories,id',
            'attrvalues' => 'required|array',
            'attrvalues.*' => 'nullable',
            'varivalues' => 'required|array',
            'varivalues.price.*' => 'required|integer',
            'varivalues.count.*' => 'required|integer',
            'varivalues.sku.*' => 'nullable'
        ]);

        try
        {
            DB::beginTransaction();

            $product->category_id = $r->category_id;
            $product->save();

            $productAttrvaluesController = new ProductAttrvalueController();
            $productAttrvaluesController->change($r, $product);

            $productVarivalueController = new ProductVarivalueController();
            $productVarivalueController->change($r, $product);

            DB::commit();
        }
        catch(\Exception $ex)
        {
            DB::rollback();

            alert()->error('ویرایش دسته بندی با شکست مواجه شد', 'ناموفق!')->persistent("بستن");

            return redirect()->back();
        }

        alert()->success('ویرایش دسته بندی با موفقیت انجام شد.', 'باتشکر!');

        return redirect()->route('admin.products.show' ,['product' => $product->id]);
    }
}
