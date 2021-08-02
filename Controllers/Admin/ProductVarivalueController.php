<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVarivalue;
use App\Http\Controllers\Controller;

class ProductVarivalueController extends Controller
{
    public function store($r, $product)
    {
        $varitype_id = Category::findOrFail($r->category_id)->attrtypes()->wherePivot('is_variation', '1')->first()->id;

        $length = count($r->varivalues['value']);

        for($i=0; $i < $length; $i++){

            $product_varivalue = new ProductVarivalue;

            $product_varivalue->attrtype_id = $varitype_id;
            $product_varivalue->product_id = $product->id;
            $product_varivalue->value = $r->varivalues['value'][$i];
            $product_varivalue->price = $r->varivalues['price'][$i];
            $product_varivalue->count = $r->varivalues['count'][$i];
            $product_varivalue->sku = $r->varivalues['sku'][$i];

            $product_varivalue->save();
        }
    }

    public function update($r, $product)
    {
        foreach($r->varivalues as $productVarId => $productVarValues)
        {
            $productVarivalue = ProductVarivalue::find($productVarId);
            $productVarivalue->price = $productVarValues['price'];
            $productVarivalue->count = $productVarValues['count'];
            $productVarivalue->sku = $productVarValues['sku'];
            $productVarivalue->sale_price = $productVarValues['sale_price'];
            $productVarivalue->date_on_sale_from = shamsiToMiladi($productVarValues['date_on_sale_from']);
            $productVarivalue->date_on_sale_to = shamsiToMiladi($productVarValues['date_on_sale_to']);
            $productVarivalue->save();
        }
    }

    public function change($r, $product)
    {
        $variationId = Category::findOrFail($r->category_id)->attrtypes()->wherePivot('is_variation', '1')->first()->id;

        ProductVarivalue::where('product_id', $product->id)->delete();

        for ($i = 0; $i< count($r->varivalues['value']); $i++)
        {
            ProductVarivalue::create([
                'product_id' => $product->id,
                'attrtype_id' => $variationId,
                'value' => $r->varivalues['value'][$i],
                'price' => $r->varivalues['price'][$i],
                'count' => $r->varivalues['count'][$i],
                'sku' => $r->varivalues['sku'][$i],
            ]);
        }
    }
}
