@extends('admin.layout')

@section('link')
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
    <style>
        #content .page .page-header {
            padding: 15px 30px 5px 30px;
        }
    </style>
@endsection

@section('title', 'Products Index_Category')

@section('content')

    <div class="page">
        <div class="page-header">
            <div class="wrapp">
                <h5 class="title"><i class="fas fa-list"></i> لیست محصولات({{ $catProducts->total() }})</h5>
                <div class="input-g mr-auto">
                    <label for="type_list">دسته ی نمایش</label>

                    <select name="type_list" id="type_list">
                        <option value="" disabled>انتخاب دسته بندی نمایش</option>
                        <option value="all" selected>همه محصولات</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $catListId ? 'selected':'' }} >{{ $category->name }}@isset($category->parent) {{'- ' . $category->parent->name}}@endisset @isset($category->parent->parent) {{'- ' . $category->parent->parent->name}}@endisset</option>
                        @endforeach
                    </select>
                </div>

                <a href="{{ route('admin.products.create') }}" class="back btn btn-sm btn-outline-primary">
                    <i class="fa fa-plus"></i>
                    <span>محصول </span>
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
                            <th>برند</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($catProducts as $product)
                            <tr>
                                <td>{{ $catProducts->firstItem() + $loop->index }}</td>
                                <td>
                                    <a href="{{ route('admin.products.show', ['product' => $product->id]) }}">
                                        <img src="{{ url(env('PRODUCT_IMAGES_PATH') . "{$product->id}" . '/' . "{$product->thumbnail_image}") }}"
                                            alt="{{ $product->name }}">
                                    </a>
                                </td>
                                <td class="pt-3">
                                    <a href="{{ route('admin.products.show', ['product' => $product->id]) }}">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td class="pt-3">{{ $product->brand->name }}</td>
                                <td class="pt-3 {{ $product->is_active == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $product->is_active == 1 ? 'فعال' : 'غیرفعال' }}</td>
                                <td class="pt-3">
                                    <a href="{{ route('admin.products.show', ['product' => $product->id]) }}"
                                        class="btn btn-sm btn-outline-success">نمایش</a>
                                    <button id="btn-collapse-edit-{{ $product->id }}"
                                        class="btn-collapse-edit btn btn-sm btn-outline-primary">ویرایش <i
                                            class="fas fa-sort-down"></i></button>
                                    <div id="collapse-edit-{{ $product->id }}" class="collapse-edit mt-2"
                                        style="display: none">
                                        <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                                            class="btn btn-sm btn-outline-info">محصول</a>
                                        <a href="{{ route('admin.products.images.edit', ['product' => $product->id]) }}"
                                            class="btn btn-sm btn-outline-info">تصاویر</a>
                                        <a href="{{ route('admin.products.category.edit', ['product' => $product->id]) }}"
                                            class="btn btn-sm btn-outline-info ml-0">دسته بندی</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $catProducts->links() }}
            </div>

        </div>
    </div>

@endsection

@section('script')
    <script>

        $('#type_list').selectpicker({
        title: 'انتخاب نوع نمایش...',
        liveSearch: true
        });

        $('#type_list').on('changed.bs.select', function ()
        {
            let categoryId = $(this).val();

            window.location.href = `{{ url('admin-panel/management/category-products/${categoryId}') }}`;
        });

        let products = @json($catProducts);

        products.data.forEach(product => {

            $(`#btn-collapse-edit-${product.id}`).click(function() {
                $(`#collapse-edit-${product.id}`).slideToggle(200);
            });
            $(`#btn-collapse-edit-${product.id}`).blur(function() {
                $(`#collapse-edit-${product.id}`).delay(150).slideUp(200);
            });
        });

    </script>
@endsection
