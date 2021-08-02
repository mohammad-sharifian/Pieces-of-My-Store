@extends('admin.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
@endsection

@section('title', 'Tags Index')

@section('content')

<div class="page">
    <div class="page-header">
        <div class="wrapp">
            <h5 class="title"><i class="fas fa-list"></i> لیست برچسب ها ({{ $tags->total() }})</h5>
            <a href="{{ route('admin.tags.create') }}" class="back btn btn-sm btn-outline-primary">
                <i class="fa fa-plus"></i>
                ایجاد برچسب
            </a>
        </div>
        <hr>
    </div>

    <div class="page-content">

        <div class="table-wr">
            <table class="table table-striped text-center table-bordered table-responsive-lg">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tags->firstItem() + $loop->index }}</td>
                        <td>
                            <a href="{{ route('admin.tags.show', ['tag' => $tag->id]) }}">
                                {{ $tag->name}}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.tags.show', ['tag' => $tag->id]) }}" class="btn btn-sm btn-outline-success">نمایش</a>
                            <a href="{{ route('admin.tags.edit', ['tag' => $tag->id]) }}" class="btn btn-sm btn-outline-info">ویرایش</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $tags->links() }}
        </div>

    </div>
</div>

@endsection

@section('script')
@endsection





