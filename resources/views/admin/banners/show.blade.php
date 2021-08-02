@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/show.css') }}">
@endsection

@section('title', 'Banner Show')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="far fa-eye text-success"></i> نمایش بنر: {{ $banner->name }}</h5>

            <div class="collapse-wrap mr-auto">
                <a href="{{ route('admin.banners.edit' , ['banner' => $banner->id]) }}" class="btn-collapse-edit btn btn-outline-primary">
                    ویرایش
                </a>
            </div>

            <a href="{{ route('admin.banners.index') }}" class="back btn btn-secondary mr-1">بازگشت</a>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <div class="form">

            <div class="input-g">
                <label>نام</label><br>
                <input name="name" id="name" type="text" value="{{ $banner->name }}" disabled>
            </div>

            <div class="input-g">
                <label>نوع</label><br>
                <input name="type" id="type" type="text" value="{{ $banner->type_to_persian }}" disabled>
            </div>

            <div class="input-g">
                <label>اولویت</label><br>
                <input name="priority" id="priority" type="text" value="{{ $banner->priority }}" disabled>
            </div>

            <div class="input-g">
                <label>عنوان</label><br>
                <input name="title" id="title" type="text" value="{{ $banner->title }}" disabled>
            </div>

            <div class="input-g">
                <label>وضعیت</label><br>
                <input value="{{ $banner->is_active == 1 ? 'فعال' : 'غیرفعال' }}" disabled>
            </div>

            <div class="input-g">
                <label>توضیحات</label><br>
                <textarea  disabled>{{ $banner->text }}</textarea>
            </div>

            <div class="input-g">
                <label>متن دکمه</label><br>
                <input name="button_text" id="button_text" type="text" value="{{ $banner->button_text }}" disabled>
            </div>

            <div class="input-g">
                <label>لینک دکمه</label><br>
                <input name="button_link" id="button_link" type="text" value="{{ $banner->button_link }}" disabled>
            </div>

            <div class="input-g">
                <label>آیکون دکمه</label><br>
                <input name="button_icon" id="button_icon" type="text" value="{{ $banner->button_icon }}" disabled>
            </div>

            <div class="input-g">
                <label for="created_at">تاریخ ایجاد</label><br>
                <input name="created_at" id="created_at" value="{{ verta($banner->created_at)->format('H:i  -  %d %B %Y') }}" disabled>
            </div>

            <div class="w-100"></div>

            <hr width="100%" height=2px style="color: black">

            <p class="text-muted">تصویر:</p>
            <div class="w-100"></div>

            <div class="primary-image">
                <img src="{{ url( env('BANNER_IMAGES_PATH') . "{$banner->id}" .'/'. "{$banner->image}") }}" alt="{{ $banner->name }}">
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
    </script>
@endsection
