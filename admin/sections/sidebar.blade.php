
<aside id="sidebar">

        <a class="home" href="#">
            <i class="far fa-smile-wink"></i>
            <span>MyWeb.ir</span>
        </a>

        <div class="links">
            <a class="link" href="#" >
                <div class="title">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span class="text">داشبورد</span>
                </div>
            </a>
        </div>

        <div class="links">
            <div class="head">فروشگاه</div>
            <a class="link {{ request()->is('admin-panel/management/brands*') ? 'active' :'' }}" href="{{ route('admin.brands.index') }}">
                <div class="title">
                    <i class="fas fa-store"></i>
                    <span class="text">برندها</span>
                </div>
            </a>

            <div tabindex="0" class="link {{ request()->is('admin-panel/management/attrtypes*') || request()->is('admin-panel/management/categories*') || request()->is('admin-panel/management/products*') || request()->is('admin-panel/management/tags*') || request()->is('admin-panel/management/category-products*') ? 'active' :''   }}">
                <div class="title">
                    <i class="fas fa-fw fa-cart-plus"></i>
                    <span class="text">محصولات</span>
                    <i class="arrow fas fa-chevron-left"></i>
                </div>
                <div class="sublinks">
                    <a href="{{ route('admin.products.index') }}" class="{{ request()->is('admin-panel/management/products*') || request()->is('admin-panel/management/category-products*') ? 'active' :'' }}">محصولات</a>
                    <a href="{{ route('admin.categories.index') }}" class="{{ request()->is('admin-panel/management/categories*') ? 'text-white' :'' }}">دسته بندی ها</a>
                    <a href="{{ route('admin.attrtypes.index') }}" class="{{ request()->is('admin-panel/management/attrtypes*') ? 'text-white' :'' }}">ویژگی ها</a>
                    <a href="{{route('admin.tags.index') }}" class="{{ request()->is('admin-panel/management/tags*') ? 'text-white' :'' }}">تگ ها</a>
                </div>
            </div>
        </div>

        <div class="links">
            <div class="head">تنظیمات</div>
            <a class="link {{ request()->is('admin-panel/management/banners*') ? 'active' :null }}" href="{{ route('admin.banners.index') }}">
                <div class="title">
                    <i class="fas fa-store"></i>
                    <span class="text">بنرها</span>
                </div>
            </a>
        </div>
        <button class="sidebar-toggle">
            <i class="fas fa-chevron-right"></i>
        </button>

</aside>

