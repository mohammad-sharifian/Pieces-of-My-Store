@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
@endsection

@section('title', 'Brand Edit')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="fas fa-edit text-primary"></i> ویرایش برند</h5>
            <div class="back-wrap mr-auto">
                <a href="{{ route('admin.brands.show',['brand' => $brand->id]) }}" class="back btn btn-secondary mb-1">نمایش <i class="fas fa-undo-alt text-warning"></i></a>
                <a href="{{ route('admin.brands.index') }}" class="back btn btn-secondary">بازگشت</a>
            </div>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <form action="{{ route('admin.brands.update',['brand' => $brand->id]) }}" method="POST">
            @csrf
            @method('put')

            <div class="input-g">
                <label for="name">نام</label><br>
                <input name="name" id="name" type="text" value="{{ old('name', $brand->name) }}">
            </div>

            <div class="input-g">
                <label for="is_active">وضعیت</label><br>
                <select name="is_active" id="is_active">
                    <option value="1" {{ old('is_active', $brand->is_active) == 1 ? 'selected' :'' }}>فعال</option>
                    <option value="0" {{ old('is_active', $brand->is_active) == 0 ? 'selected' :'' }}>غیر فعال</option>
                </select>
            </div>

            <div class="w-100"></div>

            <button class="btn btn-outline-primary">ویرایش</button>
        </form>

    </div>
</div>

@endsection

@section('script')
<script>
</script>
@endsection





