@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
@endsection

@section('title', 'Product Edit')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="fas fa-edit text-primary"></i> ویرایش محصول:<br>{{ $product->name }}</h5>
            <div class="back-wrap mr-auto">
                <a href="{{ route('admin.products.show',['product' => $product->id]) }}" class="back btn btn-secondary mb-1">نمایش <i class="fas fa-undo-alt text-warning"></i></a>
                <a href="{{ route('admin.products.index') }}" class="back btn btn-secondary">بازگشت</a>
            </div>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <form action="{{ route('admin.products.update',['product' => $product->id]) }}" method="POST">
            @csrf
            @method('put')

            <div class="input-g">
                <label for="name">نام</label><br>
                <input name="name" id="name" type="text" value="{{ old('name', $product->name) }}">
            </div>

            <div class="input-g">
                <label for="brand_id">برند</label><br>
                <select name="brand_id" id="brand_id">
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-g">
                <label for="is_active">وضعیت</label><br>
                <select name="is_active" id="is_active">
                    <option value="1" {{ old('is_active', $product->is_active) == '1' ? 'selected' :'' }}>فعال</option>
                    <option value="0" {{ old('is_active' ,$product->is_active) == '0' ? 'selected' :'' }}>غیر فعال</option>
                </select>
            </div>

            <div class="input-g">
                <label for="tag_ids">برچسب ها</label><br>
                <select name="tag_ids[]" id="tag_ids" multiple>
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ old('tag_ids', $productTagIds) && in_array($tag->id, old('tag_ids', $productTagIds)) ? 'selected' : '' }}>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-g">
                <label for="description">توضیحات</label><br>
                <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
            </div>

            <hr width="100%" height=2px style="color: black">

            <p class="text-muted">هزینه ی ارسال:</p>
            <div class="w-100"></div>

            <div class="input-g">
                <label for="delivery_amount">هزینه ی ارسال</label><br>
                <input name="delivery_amount" id="delivery_amount" value="{{ old('delivery_amount', $product->delivery_amount) }}">
            </div>

            <div class="input-g">
                <label for="delivery_amount_per_product">هزینه ی ارسال به ازای محصول اضافی</label><br>
                <input name="delivery_amount_per_product" id="delivery_amount_per_product" value="{{ old('delivery_amount_per_product' ,$product->delivery_amount_per_product) }}">
            </div>

            <hr width="100%" height=2px style="color: black">
            <p class="text-muted">ویژگی ها:</p>
            <div class="w-100"></div>

            <div id="attrvalues">
                @foreach ($productAttrValues as $productAttrVal)
                    <div class="input-g">
                        <label for="{{ $productAttrVal->id }}">{{ $productAttrVal->attrtype->name }}</label><br>
                        <input name="attrvalues[{{ $productAttrVal->id }}]" id="{{ $productAttrVal->id }}" value="{{ old("attrvalues.{$productAttrVal->id}", $productAttrVal->value) }}">
                    </div>
                @endforeach
            </div>

            <div class="w-100"></div>
            <hr width="100%" height=2px style="color: black">

            @foreach ($productVariations as $productVar)
            <span class="text-muted ml-3 mb-2">قیمت و موجودی برای ({{$productVar->attrtype->name}}: {{ $productVar->value }})</span>
            <button id="btn-coll-{{ $productVar->value }}" class="btn btn-sm btn-primary mt-0" type="button">نمایش</button>

            <div class="w-100"></div>

            <div class="collapse-variation" id="collapse-{{ $productVar->value }}" style="display: none">
                <div class="input-g">
                    <label>قیمت</label><br>
                    <input name="varivalues[{{$productVar->id}}][price]"
                        value="{{ old("varivalues.$productVar->id.price", $productVar->price) }}">
                </div>
                <div class="input-g">
                    <label>تعداد</label><br>
                    <input name="varivalues[{{$productVar->id}}][count]"
                        value="{{ old("varivalues.$productVar->id.count", $productVar->count) }}">
                </div>
                <div class="input-g">
                    <label>شناسه انبار</label><br>
                    <input name="varivalues[{{$productVar->id}}][sku]"
                        value="{{ old("varivalues.$productVar->id.sku", $productVar->sku) }}">
                </div>

                <div class="w-100"></div>
                <p class="text-muted mt-3">حراج:</p>
                <div class="w-100"></div>

                <div class="input-g">
                    <label>قیمت حراجی</label><br>
                    <input name="varivalues[{{$productVar->id}}][sale_price]"
                        value="{{ old("varivalues.$productVar->id.sale_price", $productVar->sale_price) }}">
                </div>

                <div class="input-g">
                    <label>تاریخ شروع حراجی</label><br>
                    <div class="file-wr">
                        <label class="text-file" id="label_date_on_sale_from-{{ $productVar->id }}"><i class="fas fa-clock"></i></label>
                        <input name="varivalues[{{$productVar->id}}][date_on_sale_from]" id="input_date_on_sale_from-{{ $productVar->id }}"
                            value="{{ old("varivalues.$productVar->id.date_on_sale_from" , $productVar->date_on_sale_from ? verta($productVar->date_on_sale_from)->format('Y/n/j H:i:s') : null ) }}">
                    </div>
                </div>

                <div class="input-g">
                    <label>تاریخ پایان حراجی</label><br>
                    <div class="file-wr">
                        <label class="text-file" id="label_date_on_sale_to-{{ $productVar->id }}"><i class="fas fa-clock"></i></label>
                        <input name="varivalues[{{$productVar->id}}][date_on_sale_to]" id="input_date_on_sale_to-{{ $productVar->id }}"
                        value="{{ old("varivalues.$productVar->id.date_on_sale_to" , $productVar->date_on_sale_to ? verta($productVar->date_on_sale_to)->format('Y/n/j H:i:s') : null ) }}">
                    </div>
                </div>
            </div>
            <hr width="100%" height=2px style="color: black">
            @endforeach

            <button class="btn btn-outline-primary sabt-virayesh">ویرایش</button>
        </form>

    </div>
</div>

@endsection

@section('script')
<script>
    $('#brand_id').selectpicker({
        title: 'انتخاب برند...',
        liveSearch: true
    });

    $('#is_active').selectpicker({
        title: 'انتخاب وضعیت...'
    });

    $('#tag_ids').selectpicker({
        title: 'انتخاب برچسب...',
        liveSearch: true
    });

    let productVariations = @json($productVariations);
    productVariations.forEach(productVar => {
        $(`#btn-coll-${productVar.value}`).click(function(){
            $(`#collapse-${productVar.value}`).slideToggle(200);
        })
    });

    productVariations.forEach((productVar ,key) => {
        $(`#label_date_on_sale_from-${productVar.id}`).MdPersianDateTimePicker({
        targetTextSelector: `#input_date_on_sale_from-${productVar.id}`,
        englishNumber: true,
        enableTimePicker: true,
        textFormat: 'HH:mm:ss  yyyy/MM/dd',
        });

        $(`#label_date_on_sale_to-${productVar.id}`).MdPersianDateTimePicker({
        targetTextSelector: `#input_date_on_sale_to-${productVar.id}`,
        englishNumber: true,
        enableTimePicker: true,
        textFormat: 'HH:mm:ss  yyyy/MM/dd',
        });
    });

</script>
@endsection





