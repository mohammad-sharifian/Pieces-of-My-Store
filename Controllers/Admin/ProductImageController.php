<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store($r,$product, $widthThumb, $heightThumb, $widthPrimary, $heightPrimary)
    {
        if($r->file('primary_image')->isValid()){

            // Store Originl For Images Table
            $path = $r->file('primary_image')->store($product->id, 'products');
            $name = explode('/', $path)[1];

            $product_image = new ProductImage;
            $product_image->product_id = $product->id;
            $product_image->name = $name;
            $product_image->save();

            // Resize For Primary Image
            Storage::disk('products')->makeDirectory("$product->id/primaryImage");

            $image = $r->file('primary_image');

            $img = Image::make( $image->path() );
            $img->resize($widthPrimary, $heightPrimary, function ($constraint) {
                $constraint->aspectRatio();
            })->save( public_path(env('PRODUCT_IMAGES_PATH')). "/$product->id/primaryImage/". $name );

            // Resize For Thumbnail Image
            $thumbName = "thumb_" .time() .'.' .$image->extension();
            $img = Image::make( $image->path() );
            $img->resize($widthThumb, $heightThumb, function ($constraint) {
                $constraint->aspectRatio();
            })->save( public_path(env('PRODUCT_IMAGES_PATH')). "/$product->id/". $thumbName );

            // Store Primary And Thumbnail Images
            $product->primary_image = $name;
            $product->thumbnail_image = $thumbName;
            $product->save();
        }

        // Store Images
        foreach($r->images as $image){

            if($image->isValid()){

                $path = $image->store("{$product->id}",'products');

                $name = explode('/',$path)[1];

                $product_image = new ProductImage;
                $product_image->product_id = $product->id;
                $product_image->name = $name;
                $product_image->save();
            }
        }
    }

    public function edit($p)
    {
        $product = Product::findOrFail($p)->load('productImages');

        $productImagesTrashed = ProductImage::onlyTrashed()->where('product_id',$product->id)->get();

        return view('admin.products.edit_image')
            ->with(compact('product' ,'productImagesTrashed'));
    }

    public function setPrimary(Request $r,Product $product, $widthThumb =100, $heightThumb =100, $widthPrimary =400, $heightPrimary =400)
    {
        $productImage = ProductImage::findOrFail($r->image_id);

        if($product->primary_image == $productImage->name)
        {
            return redirect()->back()->withErrors(['isPrimaryImage' => 'تصویر موردنظر قبلا بعنوان تصویر اصلی انتخاب شده است']);
        }

        if(Storage::disk('products')->exists("$product->id/primaryImage"))
        {
            Storage::disk('products')->deleteDirectory("$product->id/primaryImage");
            Storage::disk('products')->makeDirectory("$product->id/primaryImage");

            if(Storage::disk('products')->exists("$product->id/$product->thumbnail_image"))
            {
                Storage::disk('products')->delete("$product->id/$product->thumbnail_image");
            }

            $productImagePath = public_path(env("PRODUCT_IMAGES_PATH"). $product->id. "/$productImage->name");

            // Resize Select Image For Primary Image
            $img = Image::make( $productImagePath );
            $img->resize($widthPrimary, $heightPrimary, function ($constraint) {
                $constraint->aspectRatio();
            })->save( public_path(env('PRODUCT_IMAGES_PATH')). "/$product->id/primaryImage/". $productImage->name );

            // Resize Select Image For Thumbnail
            $thumbName = 'thumb_'. time().'.'. explode('.',$productImage->name)[1];
            $img->resize($widthThumb, $heightThumb, function ($constraint) {
                $constraint->aspectRatio();
            })->save( public_path(env('PRODUCT_IMAGES_PATH')). "/$product->id/". $thumbName );

            // Store Resized Selected Image For Primary Image
            $product->primary_image = $productImage->name;
            $product->save();

            // Store Resized Selected Image For Thumbnail
            $product->thumbnail_image = $thumbName;
            $product->save();

        }

        alert()->success('تصویر موردنظر بعنوان تصویر اصلی تنظیم شد.', 'باتشکر!');


        return redirect()->back();
    }

    public function delete(Request $r ,Product $product)
    {
        $productImage = ProductImage::find($r->image_id);

        if($productImage && $product->primary_image == $productImage->name)
        {
            return redirect()->back()->withErrors(['isPrimary_notDelete' => 'تصویر بعنوان تصویر اصلی انتخاب شده و قابل حذف نیست']);
        }
        if($productImage)
        {
            $productImage = ProductImage::destroy($r->image_id);
        }

        alert()->success('تصویر موردنظر با موفقیت حذف شد.', 'باتشکر!');

        return redirect()->back();
    }

    public function restore(Request $r ,Product $product)
    {
        $productImage = ProductImage::onlyTrashed()->where('product_id', $product->id)->where('id', $r->image_id)->first();

        if($productImage)
        {
           $productImage->restore();
        }

        alert()->success('تصویر موردنظر با موفقیت بازیابی شد.', 'باتشکر!');

        return redirect()->back();
    }

    public function forceDelete (Request $r ,Product $product)
    {
        $productImage = ProductImage::onlyTrashed()->where('product_id', $product->id)->where('id', $r->image_id)->first();

        if($productImage)
        {
           $productImage->forceDelete();
        }

        alert()->success('تصویر موردنظر برای همیشه حذف ❌ شد.', 'باتشکر!');

        return redirect()->back();
    }

    public function add(Request $r ,Product $product)
    {
        $r->validate([
            'images' => 'nullable|array',
            'images.*' => 'mimes:jpg,jpeg,png'
        ]);

        if($r->images == null)
        {
            return redirect()->back()->withErrors(['imagesIsNull' => 'برای اضاف کردن تصویر حداقل یک عکس وارد کنید']);
        }

        foreach($r->images as $image)
        {
            if($image->isValid())
            {
                $imagePath = $image->store("{$product->id}", 'products');
                $imageName = explode('/',$imagePath )[1];

                $ProductImage = new ProductImage;
                $ProductImage->name =  $imageName;
                $ProductImage->product_id =  $product->id;
                $ProductImage->save();
            }
        }

        alert()->success('تصویر موردنظر به تصاویر اضافه شد.', 'باتشکر!');

        return redirect()->back();
    }
}
