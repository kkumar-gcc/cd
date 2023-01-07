<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#f43f5e">
    <meta name="msapplication-TileColor" content="#f43f5e">
    <meta name="theme-color" content="#f43f5e">


    {!! seo($page ?? null) !!}
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-skin-base 2xl:shadow-lg 2xl:border-x theme-rose min-h-screen flex flex-col">

    @include('layouts.navigation')
    <!-- Page Content -->
    <main class="flex-1 w-full mt-2 text-gray-700  sm:mt-6 md:mt-16  max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>
    @include('layouts.footer')

    @livewireScripts
    @stack('scripts')
    <script src="https://platform.linkedin.com/badges/js/profile.js" async defer type="text/javascript"></script>
</body>

</html>
