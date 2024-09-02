<x-app-layout title="D.B. International Sales & Services, Inc.">

    @section('meta_title', 'D.B. International Sales & Services, Inc.')
    @section('meta_type', 'website')
    @section('meta_description', 'The Exclusive Distributor of Dunham-Bush Airconditioning, Refrigeration, Ventilation Equipment and Ice Thermal Energy System in the Philippines.')
    @section('meta_image', (asset('/Meta.png')))
    @section('meta_keywords', 'Dunham-Bush, D.B. International Sales & Services Inc., HVAC, HVAC Philippines, Airconditioning, Refrigeration, Ventilation Equipment, Ice Thermal Energy System ')

    @section('hero2')
        <!-- Hero -->
    
        <div class="w-full">
          
            <div class="relative">
                <img 
                class="absolute h-full w-full object-cover -z-10"
                src='/default-slide-1.webp'
                
                />
                <div class="gap-24 bg-gradient-to-t from-slate-900/85 to-transparent items-center md:items-start lg:items-center justify-between block md:inline-flex p-10 md:p-24">
                   
                        <div class="w-full md:w-1/3 mx-auto">
                            <img class="w-[200px] md:w-full" src="{{ asset('/DB_LOGO2_WHITE.png') }}"/>
                        </div>
                        <div class="w-full md:w-2/3 mt-4" autofocus>
                            <h1 class="w-full text-xl md:text-4xl font-extrabold text-white">
                                D.B. International Sales & Services, Inc.
                            </h1>

                            <div class="w-full text-balance text-lg md:text-xl text-white mt-4">   
                            @markdown($aboutData['Title']->description)
                            </div>
                        </div>
                    
                                
                </div>   
            </div>

            
          
        </div>

    @endsection

    <div class="my-8">
        <div class="mb-7 ">
            <div class="flex flex-col md:flex-row gap-6">
            <div class="flex flex-col w-full ">
               <div class="flex flex-col md:flex-row gap-6">
                <div class="flex-col my-auto">
                    @include('layouts.sections.about-vision')
                    @include('layouts.sections.about-mission')
                </div>
                <div class="w-full lg:w-1/3">
                    <div class="w-full px-6 py-8 space-y-4 col-span-1 md:col-span-2 lg:col-span-1 my-auto bg-white/50 rounded-xl ">
                        <div class="mx-auto w-max ">
                            <h1 class="text-3xl font-black mb-4">Need Help?</h1>
                            <div class="flex flex-col">
                                @include('layouts.sections.about-phone-support')
                                @include('layouts.sections.about-chat-support')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @include('layouts.sections.about-values')
            </div>
            
            </div>
            @include('layouts.sections.about-services')

           
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-start">
                
                
            <div class="max-w-[768px] w-full mx-auto h-auto col-span-2">
                <hr>
                <livewire:create-main-response />
            </div>
            <div class="flex flex-col gap-4 col-span-2 lg:col-span-1">
                @include('layouts.sections.about-corporate-office')
                @include('layouts.sections.about-vismin-office')
            </div>
            </div>
             

           
            
        </div>
        @include('layouts.sections.about-footer-social')
        

    </div>

    {{-- <a class="mt-7 block text-center text-lg text-blue-500 font-semibold hover:text-blue-900 cursor-pointer"
    href="{{ route('home') }}">Back to Home
    </a> --}}

</x-app-layout>
