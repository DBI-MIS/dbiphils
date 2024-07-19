<x-app-layout title="EP Solutions">

    @section('hero')
    <!-- Hero -->
    <div class="w-full bg-blue-600/50 relative">
    <div class="bg-fixed bg-no-repeat bg-cover h-1/2" 
    style="background-image: url({{ asset('/BG-EPSOLUTION.jpg') }})">
    <div class="mx-[clamp(12px,_-8.8031px_+_6.501vi,_80px)] xl:flex xl:justify-between xl:items-center">
                
        <div class="py-[clamp(52px,_-0.6195px_+_16.4436vi,_224px)] text-white">
                            <div class="">
                                <p class="font-bold text-[clamp(26px,_4.5851px_+_6.6922vi,_96px)] leading-[clamp(12px,_-8.8031px_+_6.501vi,_80px)] text-balance">Data Center Applications</p>
                                    <p class="my-[clamp(8px,_-0.566px_+_2.6769vi,_36px)] text-[clamp(12px,_4.0459px_+_2.4857vi,_38px)] leading-[clamp(12px,_4.0459px_+_2.4857vi,_38px)] font-bold text-white mb-2">{{ __('By EP Solutions') }}</p>
                            </div>
            
                            <div>
                                <p class="text-sm md:text-xl mt-4  text-balance"><strong>Surge Protection and Waveform correction</strong> - Depending on the geographical location, datacenters spend an average of 40% of their annual overall operating costs towards their power bill and 40% on their maintenance and other expenditure (*US chamber of Commerce Technology Engagement Center). The power bill and the maintenance costs are huge factors that affect the profit-maximizing conditions of the data center. The data center needs to reduce its maintenance costs and reduce its power bills to gain more profits. </p>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>

       
    
        
    @endsection

        <div class="mb-10 mt-2 sm:mt-4 md:mt-8 xl:mt-0 w-full">
            <div class="mb-16">
                <hr>
                <h2 class="my-2 sm:my-4 md:my-6 text-base md:text-lg xl:text-2xl text-gray-800 font-bold " animate-shake animate-infinite animate-ease-in>
                    Data Center SPD & Waveform Correction Devices</h2>
                <div class="w-full">
                    <div class="flex flex-col sm:grid sm:grid-cols-2 lg:grid-cols-4 sm:gap-2">

                        @foreach($featuredProducts as $product)
                        <div class="md:col-span-1 col-span-3">
                            <x-products.product-card :product="$product" />
                        </div>

                        @endforeach
                        
                    </div>
                </div>
                <a class="mt-10 block text-center text-lg text-blue-500 font-semibold"
                    href="{{ route('products.list') }}?category=ep-solutions">View All
                    Products</a>
            </div>
            <hr>

            
        </div>

        @section('other-contents')
        <div class="w-full">

            <div class="bg-gray-200 w-full px-4 py-4 md:px-12 md:py-12 lg:px-24 lg:py-24">
                @include('layouts.sections.data-protection-01')
            </div>

            <div class="bg-white w-full px-4 py-4 md:px-12 md:py-12 lg:px-24 lg:py-24">
                @include('layouts.sections.data-protection-02')
            </div>

            
            <div class="bg-gray w-full px-4 md:px-12 lg:px-24">
                @include('layouts.sections.other-footer')
            </div>


            </div>
                @endsection

                

        
    

</x-app-layout>