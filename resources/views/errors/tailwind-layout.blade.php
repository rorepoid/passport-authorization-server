<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.jpeg') }}" type="image/x-icon"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="@yield('background', 'bg-gray-300') w-screen h-screen overflow-x-hidden">
    <div id="app">
    </div>

    <main class="w-full h-full">
        <div class="text-black text-6xl font-bold text-center">
            @yield('code')
        </div>
        <div class="text-blue-900 text-5xl text-center">
            @yield('message')
        </div>
        <div class="text-gray-700 text-5xl flex justify-center">
        <img
            src="@yield('image-src')"
            alt="@yield('image-alt')"
            class="w-64 h-64 bg-gray-500"
        >
        </div>
        <div class="flex justify-center pt-3">
            <a href="{{ route('home') }}" class="p-2 rounded-lg border-2 border-gray-600 text-green-700 font-semibold mx-3 hover:no-underline hover:bg-gray-400 focus:bg-gray-500">GO HOME</a>
        </div>
    </main>

    <tailwindscripts>
</body>
</html>
