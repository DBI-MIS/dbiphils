@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> {{ isset ($title) ? $title . ' - ' : '' }} {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- <script defer src="https://unpkg.com/alpinejs-masonry@latest/dist/masonry.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@latest/dist/cdn.min.js"></script> --}}

        <script src="https://cdn.jsdelivr.net/npm/@marcreichel/alpine-typewriter/dist/alpine-typewriter.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v1.9.5/dist/alpine.js"></script>


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased w-full bg-slate-100">
        
            @include('layouts.partials.header')

            @yield('hero')
            
        
            <main class="flex
            flex-col
            mx-[clamp(12px,_-8.8031px_+_6.501vi,_80px)]">
                
                {{ $slot }}
                
            </main>
            
        
            @include('layouts.partials.footer')
        
        

        @stack('modals')

        @livewireScripts
    </body>
</html>
