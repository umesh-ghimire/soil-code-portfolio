<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Dynamic SEO Meta Tags -->
    <title>@yield('title', theme_setting('site_title', 'Umesh Ghimire - Soil & Code'))</title>
    <meta name="description" content="@yield('description', theme_setting('meta_description', 'Personal portfolio blending organic wisdom with digital craft'))">
    <meta name="keywords" content="@yield('keywords', theme_setting('meta_keywords', 'portfolio, developer, himalayas, soil and code'))">
    <meta name="author" content="Umesh Ghimire">
    
    <!-- Open Graph / Social Media -->
    <meta property="og:title" content="@yield('og_title', 'Umesh Ghimire - Soil & Code')">
    <meta property="og:description" content="@yield('og_description', 'I shape digital tools the way farmers tend terraces — with patience, respect, and generational wisdom.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body>
    <!-- Himalayan Texture Overlay -->
    <div class="himalayan-texture"></div>
    
    <!-- Header -->
    @include('partials.header')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('partials.footer')
    
    @stack('scripts')
</body>
</html>