@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta property="og:site_name" :content="title">
        <meta property="og:title" :content="title">
        <meta property="og:description" :content="description">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="en">
        <meta property="og:url" :content="title">
        <meta property="og:image" content="`/storage/${img}`">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="D.B. International Sales & Services, Inc">

        {{-- <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@stefanbauerme">
        <meta name="twitter:creator" content="@stefanbauerme">
        <meta name="twitter:title" content="Laravel Secrets">
        <meta name="twitter:image" content="{{ asset('img/twitter_summary_card.png') }}"> --}}

        <title> {{ isset ($title) ? $title . ' - ' : '' }} {{ config('app.name', 'DBI') }}</title>

        <!-- Fonts -->
        {{-- <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico')}}"> --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script defer src="https://unpkg.com/alpinejs-masonry@latest/dist/masonry.min.js"></script>

        {{-- <script defer src="https://unpkg.com/alpinejs@latest/dist/cdn.min.js"></script> --}}
        {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/@marcreichel/alpine-typewriter/dist/alpine-typewriter.min.js" defer></script>
        {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v1.9.5/dist/alpine.js"></script> --}}


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased w-full bg-slate-100">
        
        
            @include('layouts.partials.header')

            @yield('hero')
            @yield('hero2')
            
            {{-- <modal></modal> --}}
            <main class="flex
            flex-col
            mx-[clamp(12px,_-8.8031px_+_6.501vi,_80px)]">
                
                {{ $slot }}
                
            </main>
            
            @yield('other-contents')
        
            @include('layouts.partials.footer')
        
        

        @stack('modals')

        @livewireScripts

        
<div 
x-data="{ loading: false }" 
x-show="loading"
@loading.window="loading = $event.detail.loading" 
>

<style>
    /* .loader {
        border-top-color: #3498db;
        -webkit-animation: spinner 1.5s linear infinite;
        animation: spinner 1.5s linear infinite;
    }
    
    @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
        }
    }
    
    @keyframes spinner {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    } */

    @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .rotating-logo {
            animation: rotate 1.5s linear infinite;
        }
</style>

{{-- <div  
    class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
    <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
    <h2 class="text-center text-white dark:text-blue-700 text-xl font-semibold">Please wait...</h2>
</div> --}}

<div  
        class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
        <img src="{{asset('/DB_LOGO_WHITE_SPINNER.png')}}" alt="Loading..." class="h-24 w-24 rotating-logo mb-2">
        <h2 class="text-center text-white dark:text-white text-xl font-semibold">Please wait....</h2>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', () => { 
        Livewire.hook('message.sent', () => {
            window.dispatchEvent(
                new CustomEvent('loading', { detail: { loading: true }})
            );
        });
        
        Livewire.hook('message.processed', (message, component) => {
            setTimeout(() => {
                window.dispatchEvent(
                    new CustomEvent('loading', { detail: { loading: false }})
                );
            }, 2000); // Delay in milliseconds (2000ms = 2 seconds)
        });
    });
</script>



    </body>

</html>
