@extends('admin.layout')

@section('link')
    <link rel="stylesheet" href="{{ asset('css/admin/show.css') }}">
    <style>
    </style>
@endsection

@section('title', 'ProductImages Edit')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="fas fa-edit text-primary"></i> ویرایش تصاویر محصول:<br> {{ $product->name }}</h5>
            <div class="back-wrap mr-auto">
                <a href="{{ route('admin.products.show',['product' => $product->id]) }}" class="back btn btn-secondary">نمایش <i class="fas fa-undo-alt text-warning"></i></a>
                <a href="{{ route('admin.products.index') }}" class="back btn btn-secondary">بازگشت</a>
            </div>
        </div>
        <hr>
    </div>

    <div class="page-content">
        <div class="form">
            <h5 class="text-muted mt-3">تصاویر:</h5>
            <div class="w-100"></div>

            <div class="primary-image mt-4">
                <label>تصویر اصلی</label>
                <img src="{{ url( env('PRODUCT_IMAGES_PATH') . "{$product->id}" .'/primaryImage/'. "{$product->primary_image}") }}" alt="{{ $product->name }}">
            </div>

            <div class="images mt-4">
                @foreach ($product->productImages as $pImage)
                    <div class="image-wrapp">
                        <img src="{{ asset( env('PRODUCT_IMAGES_PATH') . "{$product->id}" .'/'. "{$pImage->name}") }}" alt="{{ $product->name }}">

                        <form action="{{ route('admin.products.images.setPrimary', ['product' => $product->id]) }}" method="post">
                            @csrf @method('put')
                            <input name="image_id" type="text" value="{{ $pImage->id }}" hidden>
                            <div class="btn-wrapp">
                                <button id="btnSet_{{$pImage->id}}" class="btn btn-sm btn-primary mt-1">
                                    تنظیم بعنوان تصویر اصلی
                                    <span id="spinSet_{{$pImage->id}}" class="spinner" style="display: none"></span>
                                </button>
                            </div>
                        </form>

                        <form action="{{ route('admin.products.images.delete', ['product' => $product->id]) }}" method="post">
                            @csrf @method('delete')
                            <input name="image_id" type="text" value="{{ $pImage->id }}" hidden>
                            <div id="modalDelWrapp_{{ $pImage->id }}" class="modalDelWrapp">
                                <button type="button" id="btnDel_{{$pImage->id}}" class="btn btn-sm btn-danger mt-1 mb-1">
                                    حذف تصویر
                                    <span id="spinDel_{{$pImage->id}}" class="spinner" style="display: none"></span>
                                </button>
                                <div id="modalDel_{{$pImage->id}}" class="modalDel" style="display: none">
                                    <span>آیا برای حذف مطمئن هستید؟</span>
                                    <div class="modalBtns">
                                        <button type="submit" id="yes_{{$pImage->id}}" class="btn btn-sm btn-danger ml-0">بله</button>
                                        <button type="button" id="no_{{$pImage->id}}" class="btn btn-sm btn-info mr-0">خیر</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>

            @if($productImagesTrashed !==null && $productImagesTrashed->count()>0)
                <div class="w-100"></div>
                <hr width="100%" height=2px style="color: black">
                <h5 class="text-danger mt-3">تصاویر حذف شده:</h5>
                <div class="w-100"></div>

                <div class="images mt-4">
                    @foreach ($productImagesTrashed as $pImage)
                        <div class="image-wrapp" style="border: 1px solid red">
                            <img class="trashedd" src="{{ asset( env('PRODUCT_IMAGES_PATH') . "{$product->id}" .'/'. "{$pImage->name}") }}" alt="{{ $product->name }}">

                            <form action="{{ route('admin.products.images.restore', ['product' => $product->id]) }}" method="post">
                                @csrf
                                <input name="image_id" type="text" value="{{ $pImage->id }}" hidden>
                                <div class="btn-wrapp">
                                    <button id="btnRes_{{$pImage->id}}" class="btn btn-sm btn-primary mt-1">
                                        بازیابی تصویر
                                        <span id="spinRes_{{$pImage->id}}" class="spinner" style="display: none"></span>
                                    </button>
                                </div>
                            </form>

                            <form action="{{ route('admin.products.images.forceDelete', ['product' => $product->id]) }}" method="post">
                                @csrf @method('delete')
                                <input name="image_id" type="text" value="{{ $pImage->id }}" hidden>
                                <div id="modalDelWrapp_{{ $pImage->id }}" class="modalDelWrapp">
                                    <button type="button" id="btnDel_{{$pImage->id}}" class="btn btn-sm btn-danger mt-1 mb-1">
                                        حذف همیشگی
                                        <span id="spinDel_{{$pImage->id}}" class="spinner" style="display: none"></span>
                                    </button>
                                    <div id="modalDel_{{$pImage->id}}" class="modalForcDel" style="display: none">
                                        <span>آیا برای حذف همیشگی مطمئنید؟</span>
                                        <div class="modalBtns">
                                            <button type="submit" id="yes_{{$pImage->id}}" class="btn btn-sm btn-danger ml-0">بله</button>
                                            <button type="button" id="no_{{$pImage->id}}" class="btn btn-sm btn-info mr-0">خیر</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="w-100"></div>
            <h5 class="text-muted mb-3">اضافه کردن تصویر:</h5>
            <div class="w-100"></div>

            <form action="{{ route('admin.products.images.add' ,['product' =>$product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="input-g">
                    <label for="images">انتخاب تصاویر</label><br>
                    <div class="file-wr">
                        <input class="file" name="images[]"  id="images" type="file" accept="image/jpg,image/jpeg,image/png" multiple>
                        <label for="images" class="text-button text-muted" tabindex="0">انتخاب تصاویر...</label>
                        <label for="images" class="text-file">فایل</label>
                    </div>
                </div>
                <button class="sabt btn btn-outline-primary sabt-virayesh">ثبت</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        let product = @json($product);
        let productImages = product.product_images;
        let productImagesTrashed = @json($productImagesTrashed);

        productImages.forEach(pImage =>
        {
            $(`#btnSet_${pImage.id}`).click(function ()
            {
                $(`#spinSet_${pImage.id}`).show();
            });

            $(`#btnDel_${pImage.id}`).click(function ()
            {
                $(`#modalDel_${pImage.id}`).fadeToggle();

                $(`#modalDelWrapp_${pImage.id}`).focusout(function()
                {
                    $(`#modalDel_${pImage.id}`).delay(150).fadeOut();
                });

                $(`#yes_${pImage.id}`).click(function()
                {
                    $(`#spinDel_${pImage.id}`).show();
                });

                $(`#no_${pImage.id}`).click(function()
                {
                    $(`#modalDel_${pImage.id}`).hide();
                });
            });
        });

        productImagesTrashed.forEach(pImage =>
        {
            $(`#btnRes_${pImage.id}`).click(function (event)
            {
                $(`#spinRes_${pImage.id}`).show();
            });

            $(`#btnDel_${pImage.id}`).click(function ()
            {
                $(`#modalDel_${pImage.id}`).fadeToggle();

                $(`#modalDelWrapp_${pImage.id}`).focusout(function()
                {
                    $(`#modalDel_${pImage.id}`).delay(150).fadeOut();
                });

                $(`#yes_${pImage.id}`).click(function()
                {
                    $(`#spinDel_${pImage.id}`).show();
                });

                $(`#no_${pImage.id}`).click(function()
                {
                    $(`#modalDel_${pImage.id}`).hide();
                });
            });
        });

        $("input.file").change(function() {
        let filename = this.files[0].name;

        $(this).next('.text-button').text(filename);
        $(this).next('.text-button').removeClass('text-muted');
        });

    </script>
@endsection





