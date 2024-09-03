<x-app-layout title="Products">
    <div class="grid grid-cols-5 lg:gap-10 ">
        <div class="lg:col-span-4 col-span-5 order-2 lg:order-1 ">
            <livewire:products-list />
        </div>
        <div id="side-bar"
            class="order-1 lg:order-2 border-t border-t-gray-100 md:border-t-none col-span-5 lg:col-span-1 lg:px-6 space-y-10 py-2 lg:py-6 lg:pt-10 lg:border-l 
            border-gray-100 h-full lg:h-screen relative lg:sticky top-0">

                @include('products.partials.search-box')
                @include('products.partials.categories-box')
        </div>
    </div>

</x-app-layout>