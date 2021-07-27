@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
@endsection

@section('title', 'Product Create')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="fas fa-plus text-info"></i> ایجاد محصول</h5>
        <a href="{{ route('admin.products.index') }}" class="back btn btn-secondary">بازگشت</a>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="input-g">
                <label for="name">نام</label><br>
                <input name="name" id="name" value="{{ old('name') }}">
            </div>

            <div class="input-g">
                <label for="brand_id">برند</label><br>
                <select name="brand_id" id="brand_id">
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-g">
                <label for="is_active">وضعیت</label><br>
                <select name="is_active" id="is_active">
                    <option value="1" {{ old('is_active') == '1' ? 'selected' :'' }}>فعال</option>
                    <option value="0" {{ old('is_active') == '0' ? 'selected' :'' }}>غیر فعال</option>
                </select>
            </div>

            <div class="input-g">
                <label for="tag_ids">برچسب ها</label><br>
                <select name="tag_ids[]" id="tag_ids" multiple>
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ old('tag_ids') && in_array($tag->id, old('tag_ids')) ? 'selected' : '' }}>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-g">
                <label for="description">توضیحات</label><br>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
            </div>

            <div class="w-100"></div>
            <hr width="100%" height=2px style="color: black">

            <p class="text-muted">تصویر محصول:</p>
            <div class="w-100"></div>

            <div class="input-g">
                <label for="primary_image">تصویر اصلی</label><br>
                <div class="file-wr">
                    <input class="file" name="primary_image"  id="primary_image" type="file" accept="image/jpg,image/jpeg,image/png">
                    <label for="primary_image" class="text-button text-muted" tabindex="0">انتخاب تصویر...</label>
                    <label for="primary_image" class="text-file">فایل</label>
                </div>
            </div>

            <div class="input-g">
                <label for="images">انتخاب تصاویر</label><br>
                <div class="file-wr">
                    <input class="file" name="images[]"  id="images" type="file" accept="image/jpg,image/jpeg,image/png" multiple>
                    <label for="images" class="text-button text-muted" tabindex="0">انتخاب تصاویر...</label>
                    <label for="images" class="text-file">فایل</label>
                </div>
            </div>

            <div class="w-100"></div>
            <hr width="100%" height=2px style="color: black">

            <p class="text-muted">دسته بندی و ویژگی ها:</p>
            <div class="w-100"></div>

            <div class="input-g mx-auto">
                <label for="category_id">دسته بندی</label><br>
                <select name="category_id" id="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }} - {{ $category->parent_id == 0 ? 'بدون والد' : $category->parent->name }} @isset($category->parent->parent) {{'- ' . $category->parent->parent->name}}@endisset</option>
                    @endforeach
                </select>
            </div>

            <div class="w-100"></div>

            <div id="attrvalues">
                <div class="input-g">
                </div>
            </div>

            <div class="w-100"></div>
            <p class="text-muted" id="varitypeNameP">افزودن قیمت و موجودی برای متغیر <b id="varitypeName"></b>:</p>
            <div class="w-100"></div>

            <div id="varivalues-wr">
                <div id="varivalues">
                    <div id="first">
                        <div class="recordset" >
                            <div class="input-g">
                                <label>نام</label><br>
                                <input name="varivalues[value][]">
                            </div>
                            <div class="input-g">
                                <label>قیمت</label><br>
                                <input name="varivalues[price][]">
                            </div>
                            <div class="input-g">
                                <label>تعداد</label><br>
                                <input name="varivalues[count][]">
                            </div>
                            <div class="input-g">
                                <label>شناسه انبار</label><br>
                                <input name="varivalues[sku][]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100"></div>

            <p class="text-muted">هزینه ی ارسال:</p>
            <div class="w-100"></div>

            <div class="input-g">
                <label for="delivery_amount">هزینه ی ارسال</label><br>
                <input name="delivery_amount" id="delivery_amount" value="{{ old('delivery_amount') }}">
            </div>

            <div class="input-g">
                <label for="delivery_amount_per_product">هزینه ی ارسال به ازای محصول اضافی</label><br>
                <input name="delivery_amount_per_product" id="delivery_amount_per_product" value="{{ old('delivery_amount_per_product') }}">
            </div>

            <div class="w-100"></div>

            <button class="btn btn-outline-primary sabt-virayesh">ثبت</button>
        </form>

    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('plugins/czMore-master/js/jquery.czMore-latest.js') }}"></script>
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

    $("input.file").change(function() {
        let filename = this.files[0].name;

        $(this).next('.text-button').text(filename);
        $(this).next('.text-button').removeClass('text-muted');
    });

    $('#category_id').selectpicker({
        liveSearch: true,
        title: 'انتخاب دسته بندی...'
    });

    $('#varitypeNameP').hide();
    $('#varivalues-wr').hide();

    $('#category_id').on('changed.bs.select', function (){
        let categoryId = $(this).val();

        $('#attrvalues').slideUp(200);

        $.get(`{{ url('admin-panel/management/category-attrtypes/${categoryId}') }}`)

        .done(function(response, status) {

            $('#attrvalues').find('div').remove();

            response.attrtypes.forEach(attrtype => {

                let inputG = $('<div/>',{
                    class:"input-g"
                });

                let label = $('<label/>',{
                    for: attrtype.id,
                    text: attrtype.name
                });

                let br = $('<br/>');

                let input = $('<input/>',{
                    id: attrtype.id,
                    name: `attrvalues[${attrtype.id}]`
                });

                inputG.append(label);
                inputG.append(br);
                inputG.append(input);

                $('#attrvalues').append(inputG);
            });

            $('#attrvalues').slideDown(200);

            if(response.varitype){

                $('#varitypeName').text(response.varitype.name);
            }

            $('#varitypeNameP').slideDown(200);
            $('#varivalues-wr').slideDown(200);
        })

        .fail(function() {
            alert( "اشکال در دریافت ویژگی ها" );
        });
    });

    $("#varivalues").czMore();
</script>
@endsection





