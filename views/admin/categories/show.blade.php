@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/show.css') }}">
@endsection

@section('title', 'Category Show')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="far fa-eye text-success"></i> نمایش دسته بندی: {{ $category->name }}</h5>

            <a class="virayesh btn btn-outline-primary mr-auto" href="{{ route('admin.categories.edit' ,['category' => $category->id]) }}">ویرایش</a>

            <a href="{{ route('admin.categories.index') }}" class="back btn btn-secondary mr-1">بازگشت</a>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <div class="form">

            <div class="input-g">
                <label>نام</label><br>
                <input value="{{ $category->name }}" disabled>
            </div>

            <div class="input-g">
                <label>نام انگلیسی</label><br>
                <input value="{{ $category->slug }}" disabled>
            </div>

            <div class="input-g">
                <label for="name">والد</label><br>
                <input name="name" id="name" type="text" value="{{ $category->parent_id == 0 ? 'بدون والد' : $category->parent->name }}" disabled>
            </div>

            <div class="input-g">
                <label>وضعیت</label><br>
                <input value="{{ $category->is_active == 1 ? 'فعال' : 'غیرفعال' }}" disabled>
            </div>

            <div class="input-g">
                <label>ویژگی ها</label><br>
                <input value="@foreach ($attrtypes as $attrtype) {{ $attrtype->name }} {{ $loop->last ? '' : ',' }}@endforeach" disabled>
            </div>

            <div class="input-g">
                <label>ویژگی های قابل فیلتر</label><br>
                <input value="@foreach ($is_filterAttrs as $is_filterAttr) {{ $is_filterAttr->name }} {{ $loop->last ? '' : ',' }}@endforeach" disabled>
            </div>

            <div class="input-g">
                <label>ویژگی متغیر</label><br>
                <input value="{{ $is_variationAttr[0]->name }}" disabled>
            </div>

            <div class="input-g">
                <label>آیکون</label><br>
                <input value="{{ $category->icon }}" disabled>
            </div>

            <div class="input-g">
                <label>تاریخ ایجاد</label><br>
                <input  value="{{ verta($category->created_at)->format('H:i  -  %d %B %Y') }}" disabled>
            </div>

            <div class="w-100"></div>

            <div class="input-g">
                <label>توضیحات</label><br>
                <textarea disabled>{{ $category->description }}</textarea>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>

</script>
@endsection
