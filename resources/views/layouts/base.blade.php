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
    <style>
        .milkdown-menu-wrapper {}

        .milkdown {
            box-shadow: none !important;
            border: 1px solid rgba(216, 222, 233, 1);
            border-top: none;
            /* max-height: 10rem; */
            overflow: hidden;
            overflow-y: scroll;
        }

        .milkdown-menu {
            z-index: 100;
        }

        @media screen and (min-width: 980px) {
            .editor {
                padding: 10px 50px !important;
            }
        }
    </style>
</head>

<body class="font-sans antialiased 2xl:shadow-lg 2xl:border-x theme-rose">

    <div class="min-h-screen bg-skin-base">
        @include('layouts.navigation')
        <!-- Page Content -->
        <main class="w-full px-2 mt-2 text-gray-700 sm:px-6 sm:mt-6 md:px-20 md:mt-16 dark:text-gray-300">
            {{ $slot }}
        </main>
        @include('layouts.footer')
    </div>

    @livewireScripts
    @stack('scripts')
    <script src="https://platform.linkedin.com/badges/js/profile.js" async defer type="text/javascript"></script>
</body>

</html>
