<footer class="
mx-[clamp(12px,_-8.8031px_+_6.501vi,_80px)] 
py-4 text-sm border-t border-gray-100">
    <div class="flex flex-wrap items-center justify-between">
    <div class="flex space-x-4 order-2 sm:order-1 my-5">
        <span class="text-sm">&copy;2024, D.B. International Sales & Services, Inc. All Rights Reserved. 
            <br>
            <a href="{{ route('policy') }}" >View Policy </a> 
            | Built by <a href="https://instragram.com/_exeill" rel="external">XXIV</a></span>
    </div>
    
    <div class="flex space-x-4 order-1 sm:order-2">
        
        <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">{{ __('DBI') }} </x-nav-link>
        {{-- <x-nav-link href="{{ route('projects.index') }}" :active="request()->routeIs('projects.index')">{{ __('All Projects') }} </x-nav-link> --}}
        @guest
        <x-nav-link href="/admin">{{ __('Login') }} </x-nav-link>    
        @endguest
        @auth
        <x-nav-link href="/admin">{{ Auth::user()->name }} </x-nav-link>
        @endauth
        
    </div>
    </div>
</footer>