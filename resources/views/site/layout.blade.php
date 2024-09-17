<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/favicon/favicon.ico') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-figtree min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

<div class="navbar bg-base-100 sticky top-0 z-40 shadow">
    <div class="container mx-auto">
        <div class="navbar-start">
            <div class="dropdown">
                <a href="#" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
                </a>
                <ul tabindex="0" class="menu menu-md dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-60 ">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/') }}">Services</a></li>
                    <li><a href="{{ url('/') }}">Contact Us</a></li>
                </ul>
            </div>
            <a href="{{ url('/') }}" class="btn btn-ghost text-2xl">Blog.com</a>
            <div class="hidden lg:inline-flex ml-8">
                <ul class="menu text-base menu-horizontal px-1 gap-3">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/') }}">Services</a></li>
                    <li><a href="{{ url('/') }}">Contact Us</a></li>
                </ul>
            </div>
        </div>
        {{-- <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1 gap-4">
            <li><a>Item 1</a></li>
            <li><a>Item 3</a></li>
            </ul>
        </div> --}}
        <div class="navbar-end flex justify-end">
            <a href="{{ url('/cp') }}" class="btn">Login</a>
        </div>
    </div>
</div>

<div class="container mx-auto">
    @isset ($slot)
    {{ $slot }}
    @endisset
    @yield('content')
</div>

</body>
</html>
