<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free-5.15.2-web/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/layout.css') }}">
    @yield('style')

    <title>MyWeb.ir - @yield('title')</title>
</head>
<body>

@include('home.sections.header')

<section id="content">
    @section('content')
    @show
</section>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/home/layout.js') }}"></script>

<script>
</script>

@yield('script')

</body>
</html>
