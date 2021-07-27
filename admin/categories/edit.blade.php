@extends('admin.layout')

@section('link')
    <link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
@endsection

@section('title', 'Category Edit')

@section('content')

    <div class="page">

        <div class="page-header">
            <div class="wrapp">
                <h5 class="title"><i class="fas fa-edit text-primary"></i> ویرایش دسته بندی</h5>
                <div class="back-wrap mr-auto">
                    <a href="{{ route('admin.categories.show',['category' => $category->id]) }}" class="back btn btn-secondary mb-1">نمایش <i class="fas fa-undo-alt text-warning"></i></a>
                    <a href="{{ route('admin.categories.index') }}" class="back btn btn-secondary">بازگشت</a>
                </div>
            </div>
            <hr>
        </div>

        <div class="page-content">
            <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">
                @csrf
                @method('put')

                <div class="input-g">
                    <label for="name">نام</label><br>
                    <input name="name" id="name" type="text" value="{{ old('name', $category->name) }}">
                </div>

                <div class="input-g">
                    <label for="slug">نام انگلیسی</label><br>
                    <input name="slug" id="slug" type="text" value="{{ old('slug', $category->slug) }}">
                </div>

                <div class="input-g">
                    <label for="parent_id">والد</label><br>
                    <select name="parent_id" id="parent_id">
                        <option value="0" {{ old('parent_id', $category->parent_id) == '0' ? 'selected' : '' }}>بدون والد
                        </option>
                        @foreach ($parentCats as $parentCat)
                            <option value="{{ $parentCat->id }}"
                                {{ old('parent_id', $category->parent_id) == $parentCat->id ? 'selected' : '' }}>
                                {{ $parentCat->name }}
                            </option>
                            @foreach ($parentCat->children as $child)
                                <option value="{{ $child->id }}"
                                    {{ old('parent_id', $category->parent_id) == $child->id ? 'selected' : '' }}>
                                    {{ $child->name }} @isset($child->parent)
                                    {{ '- ' . $child->parent->name }}@endisset
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="input-g">
                    <label for="is_active">وضعیت</label><br>
                    <select name="is_active" id="is_active">
                        <option value="1" {{ old('is_active', $category->is_active) == '1' ? 'selected' : '' }}>فعال
                        </option>
                        <option value="0" {{ old('is_active', $category->is_active) == '0' ? 'selected' : '' }}>غیر فعال
                        </option>
                    </select>
                </div>

                <div class="input-g">
                    <label for="attrtype_ids">ویژگی ها</label><br>
                    <select name="attrtype_ids[]" id="attrtype_ids" multiple>
                        @foreach ($attrtypes as $attrtype)
                            <option value="{{ $attrtype->id }}">{{ $attrtype->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-g">
                    <label for="is_filter_ids">انتخاب ویژگی های قابل فیلتر</label><br>
                    <select name="is_filter_ids[]" id="is_filter_ids" multiple>
                    </select>
                </div>

                <div class="input-g">
                    <label for="is_variation_id">انتخاب ویژگی متغیر</label><br>
                    <select name="is_variation_id" id="is_variation_id">
                    </select>
                </div>

                <div class="input-g">
                    <label for="icon">آیکون</label><br>
                    <input name="icon" id="icon" type="text" value="{{ old('icon', $category->icon) }}">
                </div>

                <div class="input-g">
                    <label for="description">توضیحات</label><br>
                    <textarea name="description"
                        id="description">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="w-100"></div>

                <button class="btn btn-outline-primary">ویرایش</button>
            </form>
        </div>
    </div>


@endsection

@section('script')
    <script>
        $('#is_active').selectpicker({
            title: 'انتخاب وضعیت...'
        });

        $('#parent_id').selectpicker({
            liveSearch: true,
            title: 'انتخاب والد...'
        });

        $('#attrtype_ids').selectpicker({
            liveSearch: true,
            title: 'انتخاب ویژگی...'
        });

        $('#is_filter_ids').selectpicker({
            liveSearch: true,
            title: 'انتخاب ویژگی...'
        });

        $('#is_variation_id').selectpicker({
            liveSearch: true,
            title: 'انتخاب متغیر...'
        });

        $('#attrtype_ids').on('changed.bs.select', function() {

            let selectAttrtypeIds = $(this).val();

            let attrtypes = @json($attrtypes);

            let isFilterOptions = [];
            let isVariationOptions = [];

            attrtypes.forEach(function(attrtype) {
                if (selectAttrtypeIds.includes(`${attrtype.id}`)) {

                    isFilterOptions.push($('<option/>', {
                        text: attrtype.name,
                        value: attrtype.id
                    }))

                    isVariationOptions.push($('<option/>', {
                        text: attrtype.name,
                        value: attrtype.id
                    }))
                }

            })

            $("#is_filter_ids").html(isFilterOptions);
            $('#is_filter_ids').selectpicker('refresh');

            $("#is_variation_id").html(isVariationOptions);
            $('#is_variation_id').selectpicker('refresh');


        });
    </script>
@endsection
