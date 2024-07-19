<x-app-layout title="D.B. International Sales & Services, Inc.">

    @section('hero')
        <!-- Hero -->

        <div class="w-full">

            <div 
            x-data="{
                // Sets the time between each slides in milliseconds
                autoplayIntervalTime: 6000,
            
                slides: 

                [
                        @foreach ($featuredMainSlides as $main)
                    {
                        imgSrc: '{{ $main->img ? "/storage/$main->img" : '/default-slide-1.webp' }}',
                        imgAlt: '{{ $main->title }}',
                        title: '{{ $main->title }}',
                        description: '{{ $main->notes }}',
                        ctaText: 'Contact Sales',
                        ctaText2: 'View Products',
                    }
                        @if (!$loop->last),
                        @endif 
                        @endforeach
            
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
            }"
            class="relative w-full overflow-hidden" 
            x-init="autoplay">

                <!-- slides -->
                <!-- Change min-h-[50svh] to your preferred height size -->
                <div class="relative min-h-[50svh] w-full">
                    <template x-for="(slide, index) in slides">
                        <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0"
                            x-transition.opacity.duration.3000ms>

                            <!-- Title and description -->
                            <div
                                class="lg:px-32 lg:py-14 absolute inset-0 z-10 flex flex-col justify-center gap-2 bg-gradient-to-t from-slate-900/85 to-transparent md:px-16 md:py-12 p-6"
                                x-data="{ isOpen: false }">
                                <h1 class="w-full lg:w-[80%] text-balance text-4xl md:text-6xl font-bold text-white"
                                    x-text="slide.title" x-bind:aria-describedby="'slide' + (index + 1) + 'Description'">
                                </h1>
                                <p class="lg:w-1/2 w-full text-lg md:text-2xl text-slate-300" x-text="slide.description"
                                    x-bind:id="'slide' + (index + 1) + 'Description'"></p>
                                    <div class="flex flex-row gap-4">
                                        
                                <button type="button" x-cloak
                                    class="mt-2 w-max text-left cursor-pointer whitespace-nowrap rounded-xl border border-white bg-transparent px-4 py-2 text-lg md:text-xl font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-onSurfaceDarkStrong active:opacity-100 active:outline-offset-0 hover:text-white hover:bg-blue-800"
                                    x-text="slide.ctaText"
                                    x-text="isOpen ? 'Close Modal' : 'Open Modal'"
                                    @click="isOpen = !isOpen; Livewire.dispatch(isOpen ? 'openModal' : 'closeModal')"
                                    >
                                </button>

                                <div type="button" x-cloak
                                    class="mt-2 w-max text-left cursor-pointer whitespace-nowrap rounded-xl border border-yellow-500 bg-yellow-500 px-4 py-2 text-lg md:text-xl  tracking-wide text-gray-600 font-bold transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-onSurfaceDarkStrong active:opacity-100 active:outline-offset-0 hover:text-white hover:bg-yellow-800"
                                    x-text="slide.ctaText2"
                                    wire:navigate href="{{ route('products.index') }}"
                                    >
                                </div>
                                
                                    
                                </div>
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
            </div>

        </div>


    @endsection
    
    <livewire:contact-sales />

       

        

    

                        

    <div class="my-8">
        <div class="mb-7">
            <div class="shadow-md shadow-slate-500/60 rounded-xl overflow-hidden">

                <div x-data="{
                    // Sets the time between each sliders in milliseconds
                    autoplayIntervalTime: 4000,
                
                    sliders: [
                
                        @foreach ($featuredProducts as $product)
                        {
                            imgSrc: '{{ $product->img ? "/storage/$product->img" : '/default-slide-1.webp' }}',
                            imgAlt: '{{ $product->title }}',
                            title: '{{ $product->title }}',
                        }
                            @if (!$loop->last),
                            @endif @endforeach
                
                    ],
                    currentSliderIndex: 1,
                    isPaused: false,
                    autoplayInterval: null,
                    previous() {
                        if (this.currentSliderIndex > 1) {
                            this.currentSliderIndex = this.currentSliderIndex - 1
                        } else {
                            // If it's the first slider, go to the last slider           
                            this.currentSliderIndex = this.sliders.length
                        }
                    },
                    next() {
                        if (this.currentSliderIndex < this.sliders.length) {
                            this.currentSliderIndex = this.currentSliderIndex + 1
                        } else {
                            // If it's the last slider, go to the first slider    
                            this.currentSliderIndex = 1
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
                        aria-label="previous slider" x-on:click="previous()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                            stroke-width="3" class="size-5 md:size-6 pr-0.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>

                    <!-- next button -->
                    <button type="button"
                        class="absolute hidden md:flex right-2 top-1/2 z-20  rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-slate-700 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-900/60 dark:focus-visible:outline-blue-600"
                        aria-label="next slider" x-on:click="next()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                            stroke-width="3" class="size-5 md:size-6 pl-0.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>

                    <!-- Slides -->
                    <!-- Change aspect-[3/1] to match your images aspect ratio -->
                    <div class="relative aspect-[6.5/1.5] w-full">
                        <template x-for="(slider, index) in sliders">
                            <div x-cloak x-show="currentSliderIndex == index + 1" class="absolute inset-0"
                                x-transition.opacity.duration.700ms>
                                <img class="absolute w-full h-full inset-0 object-cover text-slate-700 dark:text-slate-300"
                                    x-bind:src="slider.imgSrc" x-bind:alt="slider.imgAlt" />
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
                    {{-- <div class="absolute rounded-xl bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 px-1.5 py-1 md:px-2"
                        role="group" aria-label="sliders">
                        <template x-for="(slider, index) in sliders">
                            <button class="size-2 cursor-pointer rounded-full transition"
                                x-on:click="currentSliderIndex = index + 1"
                                x-bind:class="[currentSliderIndex === index + 1 ? 'bg-slate-300' : 'bg-slate-300/50']"
                                x-bind:aria-label="'slider ' + (index + 1)"></button>
                        </template>
                    </div> --}}
                </div>

            </div>
        </div>

        <hr>
        <a class="mt-7 block text-center text-lg text-blue-500 font-semibold hover:text-blue-900 cursor-pointer"
        wire:navigate href="{{ route('products.index') }}">View All Products
        </a>

    </div>

    @include('layouts.sections.featured-projects')

    @include('layouts.sections.featured-testimonials')

    @include('layouts.sections.services')

    @include('layouts.sections.news-events')

</x-app-layout>
