<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>عملة | @yield('title')</title>
    <meta name="description" content="@yield('description')">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>
<body>
    @include('inc.navbar')
    <div class="container">
    @include('inc.message')
    @yield('content')
    @include('inc.footer')

</div>

<script src="{{ url('/') }}/js/app.js"></script>

</body>
</html>