@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
@endsection

@section('title', 'Banner Edit')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="fas fa-edit text-primary"></i> ویرایش بنر: {{ $banner->name }}</h5>
            <div class="back-wrap mr-auto">
                <a href="{{ route('admin.banners.show',['banner' => $banner->id]) }}" class="back btn btn-secondary mb-1">نمایش <i class="fas fa-undo-alt text-warning"></i></a>
                <a href="{{ route('admin.banners.index') }}" class="back btn btn-secondary">بازگشت</a>
            </div>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <form action="{{ route('admin.banners.update',['banner' => $banner->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="input-g">
                <label for="name">نام</label><br>
                <input name="name" id="name" value="{{ old('name', $banner->name) }}">
            </div>

            <div class="input-g">
                <label for="type">نوع</label><br>
                <select name="type" id="type">
                    <option value="index_slider" {{ old('type' ,$banner->type) == 'index_slider' ? 'selected' : null }}>اسلایدر صفحه ی اصلی</option>
                    <option value="index_top" {{ old('type' ,$banner->type) == 'index_top' ? 'selected' : null }}>بنر بالای صفحه ی اصلی</option>
                    <option value="index_bottom" {{ old('type' ,$banner->type) == 'index_bottom' ? 'selected' : null }}>بنر پایین صفحه ی اصلی</option>
                    <option value="index_middle" {{ old('type' ,$banner->type) == 'index_middle' ? 'selected' : null }}>بنر میانه صفحه ی اصلی</option>
                </select>
            </div>

            <div class="input-g">
                <label for="priority">اولویت</label><br>
                <input name="priority" id="priority" value="{{ old('priority', $banner->priority) }}" type="number">
            </div>

            <div class="input-g">
                <label for="title">عنوان</label><br>
                <input name="title" id="title" value="{{ old('title', $banner->title) }}">
            </div>

            <div class="input-g">
                <label for="is_active">وضعیت</label><br>
                <select name="is_active" id="is_active">
                    <option value="1" {{ old('is_active', $banner->is_active) == '1' ? 'selected' :'' }}>فعال</option>
                    <option value="0" {{ old('is_active', $banner->is_active) == '0' ? 'selected' :'' }}>غیر فعال</option>
                </select>
            </div>

            <div class="input-g">
                <label for="description">متن</label><br>
                <textarea name="text" id="text">{{ old('text', $banner->text) }}</textarea>
            </div>

            <div class="w-100"></div>

            <div class="input-g">
                <label for="image">تصویر بنر</label><br>
                <div class="file-wr">
                    <input class="file" name="image"  id="image" type="file" accept="image/jpg,image/jpeg,image/png">
                    <label for="image" class="text-button text-muted" tabindex="0">انتخاب تصویر...</label>
                    <label for="image" class="text-file">فایل</label>
                </div>
            </div>

            <div class="input-g">
                <label for="button_text">متن دکمه</label><br>
                <input name="button_text" id="button_text" value="{{ old('button_text', $banner->button_text) }}">
            </div>

            <div class="input-g">
                <label for="button_link">لینک دکمه</label><br>
                <input name="button_link" id="button_link" value="{{ old('button_link', $banner->button_link) }}">
            </div>

            <div class="input-g">
                <label for="button_icon">آیکون دکمه</label><br>
                <input name="button_icon" id="button_icon" value="{{ old('button_icon', $banner->button_icon) }}">
            </div>

            <div class="w-100"></div>
            <hr width="100%" height=2px style="color: black">


            <hr width="100%" height=2px style="color: black">

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

    $("input.file").change(function() {
        let filename = this.files[0].name;

        $(this).next('.text-button').text(filename);
        $(this).next('.text-button').removeClass('text-muted');
    });

</script>
@endsection





