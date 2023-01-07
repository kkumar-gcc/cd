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
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased 2xl:shadow-lg 2xl:border-x theme-rose">
    <div class="min-h-screen bg-skin-base">
        @include('layouts.navigation')
        <!-- Page Content -->
        <main>
            <div class="flex-col-reverse flex justify-between lg:flex-row">
                <div
                    class="flex-none w-full lg:w-[28%] md:min-h-[calc(100vh-81px)]  px-0 md:px-12 lg:px-8 lg:border-r lg:border-gray-200">
                    {{ $sidebar ?? '' }}
                </div>
                <div class="flex-1 w-full lg:w-[70%]">
                    {{ $slot }}
                </div>
            </div>
        </main>
        @include('layouts.footer')
    </div>
    @livewireScripts
</body>

</html>
