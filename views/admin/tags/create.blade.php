@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
@endsection

@section('title', 'Tag Create')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="fas fa-plus text-info"></i> ایجاد برچسب</h5>
        <a href="{{ route('admin.tags.index') }}" class="back btn btn-secondary">بازگشت</a>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <form action="{{ route('admin.tags.store') }}" method="POST">
            @csrf

            <div class="input-g">
                <label for="name">نام</label><br>
                <input name="name" id="name" type="text" value="{{ old('name') }}">
            </div>

            <div class="w-100"></div>

            <button class="btn btn-outline-primary">ثبت</button>
        </form>

    </div>
</div>

@endsection

@section('script')
@endsection





