<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductAttrvalue;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ProductAttrvalueController extends Controller
{
    public function store($r, $product)
    {
        foreach($r->attrvalues as $id => $value){

            $product_attrvalue = new ProductAttrvalue;

            $product_attrvalue->attrtype_id = $id;
            $product_attrvalue->value = $value;
            $product_attrvalue->product_id = $product->id;

            $product_attrvalue->save();
        }
    }

    public function update($r, $product)
    {
        foreach($r->attrvalues as $attrValueId => $attrValueVal)
        {
            $productAttrvalue = ProductAttrvalue::find($attrValueId);
            $productAttrvalue->value = $attrValueVal;
            $productAttrvalue->save();
        }
    }

    public function change($r, $product)
    {
        ProductAttrvalue::where('product_id',$product->id)->delete();

        foreach($r->attrvalues as $attrtypeId => $attrvalue)
        {
            $productAttvalues = new ProductAttrvalue;
            $productAttvalues->product_id = $product->id;
            $productAttvalues->attrtype_id = $attrtypeId;
            $productAttvalues->value = $attrvalue;
            $productAttvalues->save();
        }

        return redirect()->route('admin.products.index');
    }
}
