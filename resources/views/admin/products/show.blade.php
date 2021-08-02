@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/show.css') }}">
@endsection

@section('title', 'Product Show')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="far fa-eye text-success"></i> نمایش محصول:<br> {{ $product->name }}</h5>

            <div class="collapse-wrap mr-auto">
                <button id="btn-collapse-edit"
                    class="btn-collapse-edit btn btn-outline-primary">
                    ویرایش
                    <i class="fas fa-sort-down"></i>
                </button>
                <div id="collapse-edit" class="collapse-edit mt-2"
                    style="display: none">
                    <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                        class="btn btn-sm btn-outline-info">محصول</a>
                    <a href="{{ route('admin.products.images.edit', ['product' => $product->id]) }}"
                        class="btn btn-sm btn-outline-info">تصاویر</a>
                    <a href="{{ route('admin.products.category.edit', ['product' => $product->id]) }}"
                        class="btn btn-sm btn-outline-info ml-0">دسته بندی</a>
                </div>
            </div>

            <a href="{{ route('admin.products.index') }}" class="back btn btn-secondary mr-1">بازگشت</a>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <div class="form">

            <div class="input-g">
                <label>نام</label><br>
                <input name="name" id="name" type="text" value="{{ $product->name }}" disabled>
            </div>

            <div class="input-g">
                <label>برند</label><br>
                <input value="{{ $product->brand->name }}" disabled>
            </div>

            <div class="input-g">
                <label>دسته بندی</label><br>
                <input value="{{ $product->category->name }} - {{ $product->category->parent_id == '0' ? 'بدون والد' : $product->category->parent->name }} @if($product->category->parent->parent) {{  "- {$product->category->parent->parent->name}" }} @endif" disabled>
            </div>

            <div class="input-g">
                <label>وضعیت</label><br>
                <input value="{{ $product->is_active == 1 ? 'فعال' : 'غیرفعال' }}" disabled>
            </div>

            <div class="input-g">
                <label>برچسب ها</label><br>
                <input value="@foreach ($product->tags as $tag){{ $tag->name }} {{ $loop->last ? '':',' }}  @endforeach" disabled>
            </div>

            <div class="input-g">
                <label for="created_at">تاریخ ایجاد</label><br>
                <input name="created_at" id="created_at" value="{{ verta($product->created_at)->format('H:i  -  %d %B %Y') }}" disabled>
            </div>

            <div class="w-100"></div>

            <div class="input-g">
                <label>توضیحات</label><br>
                <textarea  disabled>{{ $product->description }}</textarea>
            </div>

            <hr width="100%" height=2px style="color: black">
            <p class="text-muted">هزینه ی ارسال:</p>
            <div class="w-100"></div>

            <div class="input-g">
                <label>هزینه ی ارسال</label><br>
                <input  value="{{ $product->delivery_amount }}" disabled>
            </div>

            <div class="input-g">
                <label>هزینه ارسال به ازای محصول اضافی</label><br>
                <input value="{{ $product->delivery_amount_per_product }}" disabled>
            </div>

            <hr width="100%" height=2px style="color: black">
            <p class="text-muted">ویژگی:</p>
            <div class="w-100"></div>

            @foreach ($attributes as $attribute )
            <div class="input-g">
                <label>{{ $attribute->attrtype->name }}</label><br>
                <input  value="{{ $attribute->value }}" disabled>
            </div>
            @endforeach

            <hr width="100%" height=2px style="color: black">

            @foreach ($variations as $variation)
            <span class="text-muted mb-2">قیمت و موجودی برای ({{$variation->attrtype->name}}: {{ $variation->value }})</span>
            <button id="btn-coll-{{ $variation->id }}" class="btn btn-sm btn-primary mt-0 mr-3">نمایش</button>

            <div class="w-100"></div>

            <div class="collapse-variation" id="collapse-{{ $variation->id }}" style="display: none">
                <div class="input-g">
                    <label>قیمت</label><br>
                    <input value="{{ $variation->price }}" disabled>
                </div>
                <div class="input-g">
                    <label>تعداد</label><br>
                    <input value="{{ $variation->count }}" disabled>
                </div>
                <div class="input-g">
                    <label>شناسه انبار</label><br>
                    <input value="{{ $variation->sku }}" disabled>
                </div>

                <div class="w-100"></div>
                <p class="text-muted mt-3">حراج:</p>
                <div class="w-100"></div>

                <div class="input-g">
                    <label>قیمت حراجی</label><br>
                    <input value="{{ $variation->sale_price }}" disabled>
                </div>
                <div class="input-g">
                    <label>تاریخ شروع حراجی</label><br>
                    <input value="{{ $variation->date_on_sale_from ? verta($variation->date_on_sale_from)->format('H:i  -  %d %B %Y') : null }}" disabled>
                </div>
                <div class="input-g">
                    <label>تاریخ پایان حراجی</label><br>
                    <input value="{{ $variation->date_on_sale_to ? verta($variation->date_on_sale_to)->format('H:i  -  %d %B %Y') : null }}" disabled>
                </div>
            </div>
            <hr width="100%" height=2px style="color: black">
            @endforeach

            <hr width="100%" height=2px style="color: black">
            <p class="text-muted">تصاویر:</p>
            <div class="w-100"></div>

            <div class="primary-image">
                <label>تصویر اصلی</label>
                <img src="{{ url( env('PRODUCT_IMAGES_PATH') . "{$product->id}" .'/primaryImage/'. "{$product->primary_image}") }}" alt="{{ $product->name }}">
            </div>

            <hr width="100%" height=2px style="color: black">
            <div class="w-100"></div>

            <div class="images">
                @foreach ($images as $image)
                <div class="image-wrapp">
                    <img src="{{ asset( env('PRODUCT_IMAGES_PATH') . "{$product->id}" .'/'. "{$image->name}") }}" alt="{{ $product->name }}">
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $(`#btn-collapse-edit`).click(function() {
            $(`#collapse-edit`).slideToggle(200);
        });
        $(`#btn-collapse-edit`).blur(function() {
            $(`#collapse-edit`).delay(150).slideUp(200);
        });

        let variations = @json($variations);
        variations.forEach(variation => {
            $(`#btn-coll-${variation.id}`).click(function(){
                $(`#collapse-${variation.id}`).slideToggle(200);
            })
        });
    </script>
@endsection
