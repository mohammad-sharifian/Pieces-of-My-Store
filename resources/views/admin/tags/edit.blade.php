@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
@endsection

@section('title', 'Tag Edit')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="fas fa-edit text-primary"></i> ویرایش برچسب</h5>
            <div class="back-wrap mr-auto">
                <a href="{{ route('admin.tags.index') }}" class="back btn btn-secondary">بازگشت</a>
            </div>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <form action="{{ route('admin.tags.update',['tag' => $tag->id]) }}" method="POST">
            @csrf
            @method('put')

            <div class="input-g">
                <label for="name">نام</label><br>
                <input name="name" id="name" type="text" value="{{ old('name', $tag->name) }}">
            </div>

            <div class="w-100"></div>

            <button class="btn btn-outline-primary">ویرایش</button>
        </form>

    </div>
</div>

@endsection

@section('script')
@endsection





