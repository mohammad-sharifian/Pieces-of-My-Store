@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
@endsection

@section('title', 'Brands Index')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="fas fa-list"></i> لیست برندها ({{ $brands->total() }})</h5>
            <a href="{{ route('admin.brands.create') }}" class="back btn btn-sm btn-outline-primary">
                <i class="fa fa-plus"></i>
                ایجاد برند
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
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brands->firstItem() + $loop->index }}</td>
                        <td>
                            <a href="{{ route('admin.brands.show', ['brand' => $brand->id]) }}">
                                {{ $brand->name}}
                            </a>
                        </td>
                        <td class="{{ $brand->is_active == 1 ? 'text-success' : 'text-danger' }}">{{ $brand->is_active == 1 ? 'فعال' : 'غیرفعال' }}</td>
                        <td>
                            <a href="{{ route('admin.brands.show', ['brand' => $brand->id]) }}" class="btn btn-sm btn-outline-success">نمایش</a>
                            <a href="{{ route('admin.brands.edit', ['brand' => $brand->id]) }}" class="btn btn-sm btn-outline-info">ویرایش</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $brands->links() }}
        </div>

    </div>
</div>

@endsection

@section('script')
<script>

</script>
@endsection





