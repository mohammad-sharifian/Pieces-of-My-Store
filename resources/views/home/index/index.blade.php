@extends('home.layout')

@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/swiper_slider/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/home/index.css') }}">
@endsection

@section('content')

{{-- <div class="slider" >
    <!-- Slider main container -->
    <div class="swiper-container" tabindex="0">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <div class="wrapper">
                    <div class="content">
                        <div class="title"><h1>عنوان مورد نظر</h1></div>
                        <div class="text">
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                        </div>
                        <a href="#1" class="btn btn-lg btn-outline-danger">
                            <span class="text">کیف</span>
                            <i class="fas fa-store"></i>
                        </a>
                    </div>
                    <img src="{{ url(env('PRODUCT_IMAGES_PATH').'30/aQzdllx2PrasqAhNkl3ElJIB0fYX6nZdJpdLRATL.jpg') }}" alt="">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="wrapper">
                    <div class="content">
                        <div class="title"><h1>عنوان مورد نظر</h1></div>
                        <div class="text">متن مورد نظر</div>
                        <a href="#1" class="btn btn-lg btn-outline-danger">
                            <span class="text">فروشگاه</span>
                            <i class="fas fa-store"></i>
                        </a>
                    </div>
                    <img src="{{ url(env('PRODUCT_IMAGES_PATH').'47/cHTsHVdvVEH5xuCYEVAgZ5o1QKYG0i3bxqKT6UL6.jpg') }}" alt="">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="wrapper">
                    <div class="content">
                        <div class="title"><h1>عنوان مورد نظر</h1></div>
                        <div class="text">متن مورد نظر</div>
                        <a href="#1" class="btn btn-lg btn-outline-danger">
                            <span class="text">فروشگاه</span>
                            <i class="fas fa-store"></i>
                        </a>
                    </div>
                    <img src="{{ url(env('PRODUCT_IMAGES_PATH').'49/DD1xGY9nlfqYcwfx4OLykPKHsPApKSkTvNFjht8B.jpg') }}" alt="">
                </div>
            </div>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
        {{-- <div class="swiper-scrollbar"></div> --}}
    {{-- </div> --}}
{{-- </div> --}}

<div class="top-banners">
</div>

@endsection

@section('script')
    <script src="{{ asset('plugins/swiper_slider/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/home/index.js') }}"></script>

@endsection
