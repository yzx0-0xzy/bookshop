<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Books')</title>
    <!-- 样式 -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="">
        @include('layouts._header')
        <div class="container">
            @yield('content')
        </div>
        <a href="#app">
            <button type="button" class="btn btn-primary backTop" >
                返<br/>
                回<br/>
                顶<br/>
                部<br/>
            </button>
        </a>
    </div>
    <!-- JS 脚本 -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scriptsAfterJs')
</body>
</html>