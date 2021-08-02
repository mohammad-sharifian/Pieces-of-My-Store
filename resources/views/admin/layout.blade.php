<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free-5.15.2-web/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/layout.css') }}">
    @yield('link')

    <title>MyWeb-@yield('title')</title>
</head>
<body>

<div id="top-header-bg"></div>

@include('admin.sections.header')

<div id="bottom-header-bg"></div>

<section id="content">
    @include('admin.sections.errors')

    @section('content')
    @show
</section>

@include('admin.sections.sidebar')

@include('admin.sections.footer')


<script src="{{asset('js/app.js')}}"></script>

@include('sweet::alert')

<script src="{{ asset('js/admin/layout.js') }}"></script>

@yield('script')

</body>
</html>
