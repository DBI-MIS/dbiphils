<x-app-layout title="D.B. International Sales & Services, Inc.">

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
                        <div class="w-full md:w-2/3 mt-4">
                            <h1 class="w-full text-xl md:text-4xl font-extrabold text-white">
                                D.B. International Sales & Services, Inc.
                            </h1>

                            <div class="w-full text-base md:text-lg text-white mt-4">   
                            @markdown($aboutTitle->description)
                            </div>
                        </div>
                    
                                
                </div>   
            </div>

            
          
        </div>

    @endsection

    <div class="my-8">
        <div class="mb-7 ">
            <div class="flex flex-col md:flex-row gap-6">
            <div class="flex flex-col w-full md:w-2/3">
                @include('layouts.sections.about-vision')
                @include('layouts.sections.about-mission')
            </div>
            <div class="w-full md:w-1/3">
                @include('layouts.sections.about-values')
            </div>
            </div>
            @include('layouts.sections.about-services')
            <div class="flex flex-col md:flex-row gap-4">
                @include('layouts.sections.about-corporate-office')
                @include('layouts.sections.about-vismin-office')
            </div>
            

          
            
        </div>

        <hr>

        <a class="mt-7 block text-center text-lg text-blue-500 font-semibold hover:text-blue-900 cursor-pointer"
            href="{{ route('home') }}">Back to Home
        </a>

    </div>



</x-app-layout>
