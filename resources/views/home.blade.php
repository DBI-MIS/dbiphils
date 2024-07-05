<x-app-layout title="D.B. International Sales & Services, Inc.">

    @section('hero')
    <!-- Hero -->

            
        {{-- <div class="w-full bg-blue-600/50 relative">
            
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
                href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 md:size-7 lg:size-9 inline-block">
                    <path d="M8.25 10.875a2.625 2.625 0 1 1 5.25 0 2.625 2.625 0 0 1-5.25 0Z" />
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.125 4.5a4.125 4.125 0 1 0 2.338 7.524l2.007 2.006a.75.75 0 1 0 1.06-1.06l-2.006-2.007a4.125 4.125 0 0 0-3.399-6.463Z" clip-rule="evenodd" />
                  </svg>
                  {{ __('View Products') }}</a>
                </div>
            
                
            
            </div>
            </div>
        </div> --}}
    
        <div class="">

            <div x-data="{
                // Sets the time between each slides in milliseconds
                autoplayIntervalTime: 6000,
            
                slides: [
            
                    @foreach ($featuredSlides as $slide)
                    {
                        {{-- imgSrc: '/storage/{{ $slide->img }}', --}}
                        imgSrc: '{{ $slide->img ? "/storage/$slide->img" : "https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-1.webp" }}',
                        imgAlt: '{{ $slide->title }}',
                        title: '{{ $slide->title }}',
                        description: '{{ $slide->notes }}',
                        {{-- ctaUrl: '{{ $slide->title }}',
                        ctaText: '{{ $slide->title }}' --}}
                        ctaUrl: '{{ $slide->title }}',
                        ctaText: 'Contact Sales'
                    }
                        @if (!$loop->last),
                        @endif @endforeach
            
                ],
                currentSlideIndex: 1,
                isPaused: false,
                autoplayInterval: null,
                previous() {
                    if (this.currentSlideIndex > 1) {
                        this.currentSlideIndex = this.currentSlideIndex - 1
                    } else {
                        // If it's the first slide, go to the last slide           
                        this.currentSlideIndex = this.slides.length
                    }
                },
                next() {
                    if (this.currentSlideIndex < this.slides.length) {
                        this.currentSlideIndex = this.currentSlideIndex + 1
                    } else {
                        // If it's the last slide, go to the first slide    
                        this.currentSlideIndex = 1
                    }
                },
                autoplay() {
                    this.autoplayInterval = setInterval(() => {
                        if (!this.isPaused) {
                            this.next()
                        }
                    }, this.autoplayIntervalTime)
                },
            }" class="relative w-full overflow-hidden" x-init="autoplay">


                {{-- <!-- previous button -->
                <button type="button"
                    class="absolute left-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-slate-700 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-900/60 dark:focus-visible:outline-blue-600"
                    aria-label="previous slide" x-on:click="previous()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                        fill="none" stroke-width="3" class="size-5 md:size-6 pr-0.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <!-- next button -->
                <button type="button"
                    class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-slate-700 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-900/60 dark:focus-visible:outline-blue-600"
                    aria-label="next slide" x-on:click="next()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                        fill="none" stroke-width="3" class="size-5 md:size-6 pl-0.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button> --}}

                <!-- slides -->
                <!-- Change min-h-[50svh] to your preferred height size -->
                <div class="relative min-h-[50svh] w-full">
                    <template x-for="(slide, index) in slides">
                        <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0"
                            x-transition.opacity.duration.3000ms>

                            <!-- Title and description -->
                            <div
                                class="lg:px-32 lg:py-14 absolute inset-0 z-10 flex flex-col justify-center gap-2 bg-gradient-to-t from-slate-900/85 to-transparent md:px-16 md:py-12 p-6">
                                <h1 class="w-full lg:w-[80%] text-balance text-4xl md:text-6xl font-bold text-white"
                                    x-text="slide.title"
                                    x-bind:aria-describedby="'slide' + (index + 1) + 'Description'"></h1>
                                <p class="lg:w-1/2 w-full text-lg md:text-2xl text-slate-300"
                                    x-text="slide.description"
                                    x-bind:id="'slide' + (index + 1) + 'Description'"></p>
                                <button type="button" x-cloak x-show="slide.ctaUrl !== null"
                                    class="mt-2 w-max text-left cursor-pointer whitespace-nowrap rounded-xl border border-white bg-transparent px-4 py-2 text-lg md:text-xl font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-onSurfaceDarkStrong active:opacity-100 active:outline-offset-0 hover:text-white hover:bg-blue-800"
                                    x-text="slide.ctaText"></button>
                            </div>

                            <img class="absolute w-full h-full object-cover object-center md:object-right text-slate-700 dark:text-slate-300"
                                x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" />
                        </div>
                    </template>
                </div>

                <!-- Pause/Play Button -->
                <button type="button"
                    class="absolute bottom-5 right-5 z-20 rounded-full text-slate-300 opacity-50 transition hover:opacity-80 focus-visible:opacity-80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 active:outline-offset-0"
                    aria-label="pause carousel"
                    x-on:click="(isPaused = !isPaused), setAutoplayInterval(autoplayIntervalTime)"
                    x-bind:aria-pressed="isPaused">
                    <svg x-cloak x-show="isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true" class="size-7">
                        <path fill-rule="evenodd"
                            d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm6.39-2.908a.75.75 0 0 1 .766.027l3.5 2.25a.75.75 0 0 1 0 1.262l-3.5 2.25A.75.75 0 0 1 8 12.25v-4.5a.75.75 0 0 1 .39-.658Z"
                            clip-rule="evenodd">
                    </svg>
                    <svg x-cloak x-show="!isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true" class="size-7">
                        <path fill-rule="evenodd"
                            d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm5-2.25A.75.75 0 0 1 7.75 7h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Zm4 0a.75.75 0 0 1 .75-.75h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Z"
                            clip-rule="evenodd">
                    </svg>
                </button>

                <!-- indicators -->
                <div class="absolute rounded-xl bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 px-1.5 py-1 md:px-2"
                    role="group" aria-label="slides">
                    <template x-for="(slide, index) in slides">
                        <button class="size-2 cursor-pointer rounded-full transition"
                            x-on:click="currentSlideIndex = index + 1"
                            x-bind:class="[currentSlideIndex === index + 1 ? 'bg-slate-300' : 'bg-slate-300/50']"
                            x-bind:aria-label="'slide ' + (index + 1)"></button>
                    </template>
                </div>
            </div>

        </div>

    @endsection

    <div class="my-8">
        <div class="">
            <div class="shadow-md shadow-slate-500/60 rounded-xl overflow-hidden">

                <div x-data="{
                    // Sets the time between each slides in milliseconds
                    autoplayIntervalTime: 4000,
                
                    slides: [
                
                        @foreach ($featuredProducts as $product)
                        {
                            {{-- imgSrc: '/storage/{{ $product->img }}', --}}
                            imgSrc: '{{ $product->img ? "/storage/$product->img" : "https://penguinui.s3.amazonaws.com/component-assets/carousel/default-product-1.webp" }}',
                            imgAlt: '{{ $product->title }}',
                            title: '{{ $product->title }}',
                            description: '{{ $product->notes }}',
                            {{-- ctaUrl: '{{ $product->title }}',
                            ctaText: '{{ $product->title }}' --}}
                            ctaUrl: '{{ $product->title }}',
                            ctaText: 'Contact Sales'
                        }
                            @if (!$loop->last),
                            @endif @endforeach
                
                    ],
                    currentSlideIndex: 1,
                    isPaused: false,
                    autoplayInterval: null,
                    previous() {
                        if (this.currentSlideIndex > 1) {
                            this.currentSlideIndex = this.currentSlideIndex - 1
                        } else {
                            // If it's the first slide, go to the last slide           
                            this.currentSlideIndex = this.slides.length
                        }
                    },
                    next() {
                        if (this.currentSlideIndex < this.slides.length) {
                            this.currentSlideIndex = this.currentSlideIndex + 1
                        } else {
                            // If it's the last slide, go to the first slide    
                            this.currentSlideIndex = 1
                        }
                    },
                    autoplay() {
                        this.autoplayInterval = setInterval(() => {
                            if (!this.isPaused) {
                                this.next()
                            }
                        }, this.autoplayIntervalTime)
                    },
                }" class="relative w-full overflow-hidden" x-init="autoplay">
    
    
                    <!-- previous button -->
                    <button type="button"
                        class="absolute hidden md:flex left-2 top-1/2 z-20 rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-slate-700 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-900/60 dark:focus-visible:outline-blue-600"
                        aria-label="previous slide" x-on:click="previous()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                            fill="none" stroke-width="3" class="size-5 md:size-6 pr-0.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>
    
                    <!-- next button -->
                    <button type="button"
                        class="absolute hidden md:flex right-2 top-1/2 z-20  rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-slate-700 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-900/60 dark:focus-visible:outline-blue-600"
                        aria-label="next slide" x-on:click="next()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                            fill="none" stroke-width="3" class="size-5 md:size-6 pl-0.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
     
                    <!-- Slides -->
    <!-- Change aspect-[3/1] to match your images aspect ratio -->
    <div class="relative aspect-[6.5/1.5] w-full">
        <template x-for="(slide, index) in slides">
            <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.700ms>
                <img class="absolute w-full h-full inset-0 object-cover text-slate-700 dark:text-slate-300" 
                x-bind:src="slide.imgSrc" 
                x-bind:alt="slide.imgAlt" />
            </div>
        </template>
    </div>
    
                    <!-- Pause/Play Button -->
                    <button type="button"
                        class="absolute hidden md:inline bottom-5 right-5 z-20 rounded-full text-slate-300 opacity-50 transition hover:opacity-80 focus-visible:opacity-80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 active:outline-offset-0"
                        aria-label="pause carousel"
                        x-on:click="(isPaused = !isPaused), setAutoplayInterval(autoplayIntervalTime)"
                        x-bind:aria-pressed="isPaused">
                        <svg x-cloak x-show="isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true" class="size-7">
                            <path fill-rule="evenodd"
                                d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm6.39-2.908a.75.75 0 0 1 .766.027l3.5 2.25a.75.75 0 0 1 0 1.262l-3.5 2.25A.75.75 0 0 1 8 12.25v-4.5a.75.75 0 0 1 .39-.658Z"
                                clip-rule="evenodd">
                        </svg>
                        <svg x-cloak x-show="!isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true" class="size-7">
                            <path fill-rule="evenodd"
                                d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm5-2.25A.75.75 0 0 1 7.75 7h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Zm4 0a.75.75 0 0 1 .75-.75h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Z"
                                clip-rule="evenodd">
                        </svg>
                    </button>
    
                    <!-- indicators -->
                    <div class="absolute rounded-xl bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 px-1.5 py-1 md:px-2"
                        role="group" aria-label="slides">
                        <template x-for="(slide, index) in slides">
                            <button class="size-2 cursor-pointer rounded-full transition"
                                x-on:click="currentSlideIndex = index + 1"
                                x-bind:class="[currentSlideIndex === index + 1 ? 'bg-slate-300' : 'bg-slate-300/50']"
                                x-bind:aria-label="'slide ' + (index + 1)"></button>
                        </template>
                    </div>
                </div>
    
            </div>
            
                {{-- @foreach ($featuredSlides as $slide)
                        <x-page.slider :slide="$slide" />
                    @endforeach --}}

                {{-- <div x-data x-masonry class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                </div> --}}


        </div>

    </div>

    @include('layouts.sections.featured-projects')

    @include('layouts.sections.featured-testimonials')

</x-app-layout>
