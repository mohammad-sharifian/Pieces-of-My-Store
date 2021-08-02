@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
@endsection

@section('title', 'Brand Create')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="fas fa-plus text-info"></i> ایجاد برند</h5>
            <a href="{{ route('admin.brands.index') }}" class="back btn btn-secondary">بازگشت</a>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <form action="{{ route('admin.brands.store') }}" method="POST">
            @csrf

            <div class="input-g">
                <label for="name">نام</label><br>
                <input name="name" id="name" type="text" value="{{ old('name') }}">
            </div>

            <div class="input-g">
                <label for="is_active">وضعیت</label><br>
                <select name="is_active" id="is_active">
                    <option value="1">فعال</option>
                    <option value="0">غیر فعال</option>
                </select>
            </div>

            <div class="w-100"></div>

            <button class="btn btn-outline-primary">ثبت</button>
        </form>

    </div>
</div>

@endsection

@section('script')
<script>
$('#is_active').selectpicker({
    title: 'انتخاب وضعیت...'
});
</script>
@endsection





