@extends('admin.layout')

@section('link')
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
@endsection

@section('title', 'Banners Index')

@section('content')

    <div class="page">
        <div class="page-header">
            <div class="wrapp">
                <h5 class="title"><i class="fas fa-list"></i> لیست بنرها ({{ $banners->total() }})</h5>

                <a href="{{ route('admin.banners.create') }}" class="back btn btn-sm btn-outline-primary">
                    <i class="fa fa-plus"></i>
                    <span class="add"><span class="res-xs">ایجاد</span> بنر <span class="res-xs">جدید</span></span>
                </a>
            </div>
            <hr>
        </div>

        <div class="page-content">

            <div class="table-wr">
                <table class="table table-sm table-striped text-center table-bordered table-responsive-lg">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th><i class="fas fa-image"></i></th>
                            <th>نام</th>
                            <th>عنوان</th>
                            <th>نوع</th>
                            <th>اولویت</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                            <tr>
                                <td>{{ $banners->firstItem() + $loop->index }}</td>
                                <td>
                                    <a href="{{ route('admin.banners.show', ['banner' => $banner->id]) }}">
                                        <img src="{{ url(env('BANNER_IMAGES_PATH') . "{$banner->id}" . '/' . "{$banner->thumbnail_image}") }}"
                                            alt="{{ $banner->name }}">
                                    </a>
                                </td>
                                <td class="pt-3">
                                    <a href="{{ route('admin.banners.show', ['banner' => $banner->id]) }}">
                                        {{ $banner->name }}
                                    </a>
                                </td>
                                <td class="pt-3">
                                    {{ $banner->title }}
                                </td>
                                <td class="pt-3">{{ $banner->type_to_persian }}</td>
                                <td class="pt-3">{{ $banner->priority }} @isset($banner->category->parent)<span class="text-black-50">{{'- ' . $banner->category->parent->name}}</span>@endisset @isset($banner->category->parent->parent) <span class="text-black-50">{{'- ' . $banner->category->parent->parent->name}}</span>@endisset</td>
                                <td class="pt-3 {{ $banner->is_active == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $banner->is_active == 1 ? 'فعال' : 'غیرفعال' }}
                                </td>
                                <td class="pt-3">
                                    <a href="{{ route('admin.banners.show', ['banner' => $banner->id]) }}"
                                        class="btn btn-sm btn-outline-success">نمایش</a>
                                    <a href="{{ route('admin.banners.edit' ,['banner' => $banner->id]) }}" class="btn-collapse-edit btn btn-sm btn-outline-primary">
                                        ویرایش
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $banners->links() }}
            </div>

        </div>
    </div>

@endsection

@section('script')
    <script>

        // $.get( `{{ url('admin-panel/management/banners/') }}` );

        $('#type_list').selectpicker({
        title: 'انتخاب نوع نمایش...',
        liveSearch: true
        });

        $('#type_list').on('changed.bs.select', function ()
        {
            let categoryId = $(this).val();

            window.location.href = `{{ url('admin-panel/management/category-banners/${categoryId}') }}`;
        });

        let banners = @json($banners);

        banners.data.forEach(banner => {

            $(`#btn-collapse-edit-${banner.id}`).click(function() {
                $(`#collapse-edit-${banner.id}`).slideToggle(200);
            });
            $(`#btn-collapse-edit-${banner.id}`).blur(function() {
                $(`#collapse-edit-${banner.id}`).delay(150).slideUp(200);
            });
        });

    </script>
@endsection
