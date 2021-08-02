@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/show.css') }}">
@endsection

@section('title', 'Tag Show')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="far fa-eye text-success"></i> نمایش برچسب: {{ $tag->name }}</h5>

            <a class="virayesh btn btn-outline-primary mr-auto" href="{{ route('admin.tags.edit' ,['tag' => $tag->id]) }}">ویرایش</a>

            <a href="{{ route('admin.tags.index') }}" class="back btn btn-secondary mr-1">بازگشت</a>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <div class="form">

            <div class="input-g">
                <label for="name">نام</label><br>
                <input name="name" id="name" type="text" value="{{ $tag->name }}" disabled>
            </div>

            <div class="input-g">
                <label for="created_at">تاریخ ایجاد</label><br>
                <input name="created_at" id="created_at" value="{{ verta($tag->created_at)->format('H:i  -  %d %B %Y') }}" disabled>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@endsection
