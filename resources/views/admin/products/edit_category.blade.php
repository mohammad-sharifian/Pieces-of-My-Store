@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
@endsection

@section('title', 'ProductCategory Edit')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="fas fa-edit text-primary"></i> ویرایش دسته بندی و ویژگی ها:<br> {{ $product->name }}</h5>
            <div class="back-wrap mr-auto">
                <a href="{{ route('admin.products.show',['product' => $product->id]) }}" class="back btn btn-secondary mb-1">نمایش <i class="fas fa-undo-alt text-warning"></i></a>
                <a href="{{ route('admin.products.index') }}" class="back btn btn-secondary">بازگشت</a>
            </div>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <form action="{{ route('admin.products.category.update',['product' => $product->id]) }}" method="POST">
            @csrf
            @method('put')

            <div class="input-g mx-auto">
                <label for="category_id">دسته بندی</label><br>
                <select name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $productCategoryId ? 'selected':null}}>{{ $category->name }} - {{ $category->parent_id == 0 ? 'بدون والد' : $category->parent->name }} @isset($category->parent->parent) {{'- ' . $category->parent->parent->name}}@endisset</option>
                    @endforeach
                </select>
            </div>

            <div class="w-100"></div>

            <div id="attrvalues">
                <div class="input-g">
                </div>
            </div>

            <div class="w-100 mt-3"></div>
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

            <button class="btn btn-outline-primary sabt-virayesh">ویرایش</button>
        </form>

    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('plugins/czMore-master/js/jquery.czMore-latest.js') }}"></script>
<script>

    $('#category_id').selectpicker({
        liveSearch: true,
        title: 'انتخاب دسته بندی...'
    });

    $('#attrvalues').hide();
    $("#varivalues-wr").hide();
    $('#varitypeNameP').hide();

    $('#category_id').on('changed.bs.select', function (){
        let categoryId = $(this).val();

        $('#attrvalues').slideUp();

        $.get(`{{ url('admin-panel/management/category-attrtypes/${categoryId}') }}`)
        .done(function(response, state)
        {
            if(state == 'success')
            {
                $('#attrvalues').find('div').remove();


                response.attrtypes.forEach(attrtype =>
                {
                    let inputG = $('<div/>',{
                        class: 'input-g'
                    });

                    let label = $('<label/>',{
                        text: `${attrtype.name}`,
                        for: attrtype.id
                    });

                    let br = $('<br>');

                    let input = $('<input>',{
                        name: `attrvalues[${attrtype.id}]`,
                        id:attrtype.id,
                        type: 'text'
                    })

                    inputG.append(label);
                    inputG.append(br);
                    inputG.append(input);

                    $('#attrvalues').append(inputG);

                    $('#attrvalues').slideDown();
                });
            }

            if(response.varitype)
            {
                $('#varitypeName').text(response.varitype.name);

                $('#varitypeNameP').fadeIn();
                $("#varivalues-wr").slideDown();
            }
        })
        .fail(function()
        {
            alert( "اشکال در دریافت ویژگی ها" );
        });
    });

    $("#varivalues").czMore();

</script>
@endsection





