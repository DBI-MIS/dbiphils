<x-app-layout title="Home Page">
    @section('hero')
    <!-- Hero -->

            
        <div class="w-full bg-blue-600/50 relative">
            
            <div class="bg-fixed bg-no-repeat bg-cover h-1/2" 
    style="background-image: url({{ asset('/Background06.png') }})">
            
            <div class="mx-[clamp(12px,_-8.8031px_+_6.501vi,_80px)] xl:flex xl:justify-between xl:items-center">
                
                <div class="py-[clamp(52px,_-0.6195px_+_16.4436vi,_224px)]">
                <!-- Hero Title -->
                <h1 class="font-bold text-[clamp(26px,_4.5851px_+_6.6922vi,_96px)] leading-[clamp(12px,_-8.8031px_+_6.501vi,_80px)] text-balance text-white">
                Technology That
                <br>Delivers
                <span x-data="{ texts: ['Value', 'Efficiency','Innovation','Impact'] }" 
                x-typewriter.3000ms="texts">
                </span>
                <p class="my-[clamp(8px,_-0.566px_+_2.6769vi,_36px)] text-[clamp(12px,_4.0459px_+_2.4857vi,_38px)] leading-[clamp(12px,_4.0459px_+_2.4857vi,_38px)] font-thin text-white mb-2">{{ __('Building Sustainable Future Through Green Technology') }}</p>
                </h1>
                <!-- Call to Action Button -->
                <a class="my-[clamp(2px,_-1.0593px_+_0.956vi,_12px)] inline-block px-[clamp(12px,_5.8815px_+_1.912vi,_32px)] py-[clamp(2px,_-1.0593px_+_0.956vi,_12px)] text-[clamp(14px,_10.9407px_+_0.956vi,_24px)] text-black bg-yellow-500 rounded-lg  shadow-sm shadow-gray-950 hover:text-white hover:bg-slate-800 items-center" 
                href="{{ route('products.list') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 md:size-7 lg:size-9 inline-block">
                    <path d="M8.25 10.875a2.625 2.625 0 1 1 5.25 0 2.625 2.625 0 0 1-5.25 0Z" />
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.125 4.5a4.125 4.125 0 1 0 2.338 7.524l2.007 2.006a.75.75 0 1 0 1.06-1.06l-2.006-2.007a4.125 4.125 0 0 0-3.399-6.463Z" clip-rule="evenodd" />
                  </svg>
                  {{ __('All Products') }}</a>
                </div>
            
                
            
            </div>
            </div>
        </div>
    
        
    @endsection
    
    @include('layouts.sections.our-products')

        <div class="mb-10 w-full">
            <div class="my-10">
                <hr>
                <h1 class="my-2 sm:my-4 md:my-6 text-xl xl:text-2xl text-gray-800 font-bold " animate-shake animate-infinite animate-ease-in>
                    Featured Products</h1>
                <div class="w-full">
                    <div class="flex flex-col sm:grid sm:grid-cols-2 lg:grid-cols-4 sm:gap-2">

                        @foreach($featuredProducts as $product)
                        <div class="md:col-span-1">
                            <x-products.product-card :product="$product" />
                        </div>

                        @endforeach
                        
                    </div>
                </div>
                <a class="mt-10 block text-center text-lg text-blue-500 font-semibold"
                    href="{{ route('products.list') }}">View All
                    Products</a>
            </div>
            <hr>

            
        </div>

        @section('other-contents')
        <div class="w-full">
            <div class="bg-gray-200 w-full px-4 py-4 md:px-12 md:py-12 lg:px-24 lg:py-24">
                @include('layouts.sections.high-reliability')
            </div>
            <div class="bg-white w-full px-4 py-4 md:px-12 md:py-12 lg:px-24 lg:py-24">
                @include('layouts.sections.unique-patented')
            </div>
            <div class="bg-gray-200 w-full px-4 py-4 md:px-12 md:py-12 lg:px-24 lg:py-24">
                @include('layouts.sections.excellent-performance')
              </div>
            <div class="bg-white w-full px-4 py-4 md:px-12 md:py-12 lg:px-24 lg:py-24">
                    @include('layouts.sections.green-building')
                </div>
            </div>
                @endsection

        
    

</x-app-layout>