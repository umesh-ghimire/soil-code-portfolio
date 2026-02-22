<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <!-- Responsive Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#c17b5c">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Dynamic SEO Meta Tags -->
    <title>@yield('title', theme_setting('site_title', 'Umesh Ghimire - Soil & Code'))</title>
    <meta name="description" content="@yield('description', theme_setting('meta_description', 'Personal portfolio blending organic wisdom with digital craft'))">
    <meta name="keywords" content="@yield('keywords', theme_setting('meta_keywords', 'portfolio, developer, himalayas, soil and code'))">
    <meta name="author" content="{{ theme_setting('site_author', 'Umesh Ghimire') }}">
    
    <!-- Open Graph / Social Media -->
    <meta property="og:title" content="@yield('og_title', theme_setting('site_title', 'Umesh Ghimire - Soil & Code'))">
    <meta property="og:description" content="@yield('og_description', theme_setting('meta_description', 'I shape digital tools the way farmers tend terraces.'))">
    <meta property="og:image" content="{{ theme_setting('og_image') ? asset('storage/' . theme_setting('og_image')) : asset('images/og-default.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', theme_setting('site_title', 'Umesh Ghimire - Soil & Code'))">
    <meta name="twitter:description" content="@yield('description', theme_setting('meta_description', 'Personal portfolio blending organic wisdom with digital craft'))">
    <meta name="twitter:image" content="{{ theme_setting('og_image') ? asset('storage/' . theme_setting('og_image')) : asset('images/og-default.jpg') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&family=Tiro+Devanagari+Sanskrit:ital@0;1&display=swap" rel="stylesheet">
    
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