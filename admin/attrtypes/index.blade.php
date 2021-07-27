@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
@endsection

@section('title', 'Attributes Index')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="fas fa-list"></i> لیست ویژگی ها ({{ $attrtypes->total() }})</h5>
            <a href="{{ route('admin.attrtypes.create') }}" class="back btn btn-sm btn-outline-primary">
                <i class="fa fa-plus"></i>
                ایجاد ویژگی
            </a>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <div class="table-wr">
            <table class="table table-striped text-center table-bordered table-responsive-md">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attrtypes as $attrtype)
                    <tr>
                        <td>{{ $attrtypes->firstItem() + $loop->index }}</td>
                        <td>
                            <a href="{{ route('admin.attrtypes.show', ['attrtype' => $attrtype->id]) }}">
                                {{ $attrtype->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.attrtypes.show', ['attrtype' => $attrtype->id]) }}" class="btn btn-sm btn-outline-success">نمایش</a>
                            <a href="{{ route('admin.attrtypes.edit', ['attrtype' => $attrtype->id]) }}" class="btn btn-sm btn-outline-info">ویرایش</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $attrtypes->links() }}
        </div>

    </div>
</div>

@endsection

@section('script')
@endsection





