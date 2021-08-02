@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
@endsection

@section('title', 'Categories Index')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="fas fa-list"></i> لیست دسته بندی ها ({{ $categories->total() }})</h5>
            <a href="{{ route('admin.categories.create') }}" class="back btn btn-sm btn-outline-primary">
                <i class="fa fa-plus"></i>
                ایجاد دسته بندی
            </a>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <div class="table-wr">
            <table class="table table-striped text-center table-bordered table-responsive-lg">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>نام انگلیسی</th>
                        <th>والد</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $loop->index }}</td>
                        <td>
                            <a href="{{ route('admin.categories.show', ['category' => $category->id]) }}">
                                {{ $category->name}}
                            </a>
                        </td>
                        <td>{{ $category->slug}}</td>
                        <td>{{ $category->parent_id == 0 ? 'بدون والد': "{$category->parent->name}" }} @isset($category->parent->parent) {{'- ' . $category->parent->parent->name}}@endisset </td>
                        <td class="{{ $category->is_active == 1 ? 'text-success' : 'text-danger' }}">{{ $category->is_active == 1 ? 'فعال' : 'غیرفعال' }}</td>
                        <td>
                            <a href="{{ route('admin.categories.show', ['category' => $category->id]) }}" class="btn btn-sm btn-outline-success">نمایش</a>
                            <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-sm btn-outline-info">ویرایش</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $categories->links() }}
        </div>

    </div>
</div>

@endsection

@section('script')
<script>

</script>
@endsection





