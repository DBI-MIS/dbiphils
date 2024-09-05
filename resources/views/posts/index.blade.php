<x-app-layout title="News & Events">
    <div class="my-4">
        <h2 class="text-4xl font-black">News & Events</h2>
        <span class="font-light text-base">  </span>
        
    </div>
    <hr>
    <div class="grid grid-cols-5 md:gap-10">
        <div class="md:col-span-4 col-span-5 order-2 md:order-1">
            <livewire:posts-list />
        </div>
        <div id="side-bar"
            class="order-1 md:order-2 border-t border-t-gray-100 md:border-t-none col-span-5 md:col-span-1 md:px-6 space-y-10 py-2 md:py-6 md:pt-10 md:border-l 
            border-gray-100 h-full md:h-screen relative md:sticky top-0">

                @include('posts.partials.search-box')
                {{-- @include('posts.partials.categories-box') --}}
        </div>
    </div>
</x-app-layout>


