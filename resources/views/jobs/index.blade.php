<x-app-layout title="Careers">

    @section('meta_title', 'Job Vacancies')
    @section('meta_type', 'website')
    @section('meta_description', 'Be Part of Our Dynamic Team')
    @section('meta_image', (asset('/Meta_jobpost.png')))
    @section('meta_keywords', 'Dunham-Bush, D.B. International Sales & Services Inc., HVAC, HVAC Philippines, Airconditioning, Refrigeration, Ventilation Equipment, Ice Thermal Energy System, Job Vacancies, DBI Jobs, Trabaho, Pilipinas Trabaho, Philippines Job ')

    @section('hero')
    <!-- Hero -->
            
        <div class="w-full relative">
            <!-- Hero Video -->
            
            <div class="absolute left-0 top-0 overflow-hidden -z-20 w-full bg-gradient-to-r from-sky-900 via-sky-200 brightness-50">
                <video autoplay loop muted poster class="pointer-events-none object-cover">
                    <source src="{{asset('/AvpShort.webm')}}" type="video/webm">
                    <source src="https://dbiphils.com/AvpShort.webm" type="video/webm">
                </video>
            </div>
            <div class="mx-[clamp(12px,_-8.8031px_+_6.501vi,_80px)] xl:flex xl:justify-between xl:items-center">
                <div class="
                {{-- py-5 --}}
                py-[clamp(18px,_-38.3478px_+_17.6087vw,_180px)]
                ">
                <!-- Hero Title -->
                <h2 class="font-bold text-[clamp(26px,_4.5851px_+_6.6922vi,_96px)] leading-[clamp(12px,_-8.8031px_+_6.501vi,_80px)] text-balance text-white">
                Join Our Team
                <br>& 
                <span x-data="{ texts: ['Thrive!', 'Succeed!','Flourish!','Grow!','Prosper!'] }" 
                x-typewriter.3000ms="texts">
                </span>
                <p class="my-[clamp(8px,_-0.566px_+_2.6769vi,_36px)] text-[clamp(12px,_4.0459px_+_2.4857vi,_38px)] leading-[clamp(12px,_4.0459px_+_2.4857vi,_38px)] font-thin text-white mb-2">{{ __('Drive your future forward') }}</p>
                </h2>

                 <!-- Search Form -->
                 <div class="mt-4">
                    <form action="{{ route('jobs.list') }}" method="GET" class="block">
                        <input 
                        type="text" 
                        name="search" 
                        id="searchInput" 
                        class="w-full px-4 py-2 rounded-lg text-gray-800 bg-white/80 h-max text-base md:text-xl" 
                        placeholder="Search for job...">

                        <button 
                        id="searchButton"
                        type="submit"
                        class="my-[clamp(2px,_-1.0593px_+_0.956vi,_12px)] inline-block px-[clamp(12px,_5.8815px_+_1.912vi,_32px)] 
                        py-3
                        text-[clamp(14px,_10.9407px_+_0.956vi,_24px)]
                         text-black
                          bg-yellow-500
                           rounded-lg
                             shadow-sm
                              shadow-gray-950
                               hover:text-white
                                hover:bg-slate-800
                         items-center" 
                        href="{{ route('products.list') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 md:size-7 lg:size-9 inline-block">
                            <path d="M8.25 10.875a2.625 2.625 0 1 1 5.25 0 2.625 2.625 0 0 1-5.25 0Z" />
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.125 4.5a4.125 4.125 0 1 0 2.338 7.524l2.007 2.006a.75.75 0 1 0 1.06-1.06l-2.006-2.007a4.125 4.125 0 0 0-3.399-6.463Z" clip-rule="evenodd" />
                          </svg>
                          <span id="buttonText">All Jobs</span>
                        </button>
                    </form>
                </div>

                <script>
                    const searchInput = document.getElementById('searchInput');
                    const searchButton = document.getElementById('buttonText');
                
                    searchInput.addEventListener('input', () => {
                        if (searchInput.value.trim() !== '') {
                            searchButton.textContent = 'Search';
                        } else {
                            searchButton.textContent = 'All Jobs';
                        }
                    });
                </script>
                </div>
            
                
                <!-- Banner Container -->
                <div class="w-full xl:w-1/6 xl:py-[clamp(52px,_-0.6195px_+_16.4436vi,_224px)]">

                <!-- Banner Details -->
                    <div class="flex flex-row justify-between text-gray-800 xl:text-white xl:flex-col xl:items-end">
                        
                        <div class="leading-3 w-full xl:mb-5">
                            <hr class="hidden xl:block">
                            <span class="text-xs lg:text-sm xl:text-base">Serving</span><br>
                            <span class="text-xl sm:text-3xl lg:text-4xl xl:text-5xl font-semibold">500+</span><br>
                            <span class="text-xs lg:text-sm xl:text-base">Clients/Projects</span>
                        </div>
                        <div class="leading-3 w-full xl:mb-5">
                            <hr class="hidden xl:block">
                            <span class="text-xs lg:text-sm xl:text-base">Proudly</span><br>
                            <span class="text-xl sm:text-3xl lg:text-4xl xl:text-5xl font-semibold inline-block">35<span class="text-xl">Years</span></span><br>
                            <span class="text-xs lg:text-sm xl:text-base">in Service</span>
                        </div>
                        <div class="leading-3 w-full xl:mb-5">
                            <hr class="hidden xl:block">
                            <span class="text-xs lg:text-sm xl:text-base">Among the Top</span><br>
                            <span class="text-xl sm:text-3xl lg:text-4xl xl:text-5xl font-semibold inline-block"><span class="text-xl align-top">No.</span>51</span><br>
                            <a href="https://ph.prosple.com/top-employers">
                            <span class="text-xs lg:text-sm xl:text-base italic text-pretty text-yellow-400 shadow-white">*Employer for Fresh Graduates</span></a>
                        </div>  
                    </div>                       
                    
            
                </div>
            </div>

        </div>
    
        
    @endsection
    
    

        <div class="mb-10 mt-2 sm:mt-4 md:mt-6 xl:mt-0 w-full">
            <div class="mb-16">
                <hr>
                <h2 class="my-2 sm:my-4 md:my-6 text-2xl md:text-3xl text-gray-800 font-bold 2xl:text-white" animate-shake animate-infinite animate-ease-in>
                    Featured Jobs</h2>
                <div class="w-full">
                    <div class="grid grid-cols-2 gap-2">

                        @foreach($featuredPosts as $post)
                        <div class="md:col-span-1 col-span-3">
                            <x-jobs.job-card :post="$post" />
                        </div>

                        @endforeach
                        
                    </div>
                </div>
                <a class="mt-10 block text-center text-sm text-blue-500 font-semibold"
                    href="{{ route('jobs.list') }}">More
                    Jobs</a>
            </div>
            <hr>

            
        </div>
    

</x-app-layout>