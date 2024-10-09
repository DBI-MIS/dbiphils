@props(['testimonial'])

    <div class="h-max w-full rounded-xl border border-opacity-10 shadow-lg bg-white hover:bg-gray-100 border-blue-800 col-span-1 overflow-hidden cursor-pointer hover:scale-110 hover:z-50 transition-transform">
        <div class="text-balance flex flex-col h-max">
            
            <div class="gap-2 mt-4">
                <img
                class="mx-auto h-24" 
                src="/storage/{{ $testimonial->img }}" 
                alt="{{ $testimonial->title }}" >
                {{-- <img class="w-auto h-auto " src="{{ $testimonial->img }}" alt=""> --}}
            </div>

            <div class="flex flex-col gap-2 px-10 py-4 text-center">
                
                <svg class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                    <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
                </svg>
                <span class="text-pretty leading-8">{!! $testimonial->description !!}</span>
                <span class="text-lg font-bold text-balance leading-tight mt-4">{{ $testimonial->title }}</span>
                <button class="mx-auto text-base font-light rounded-xl px-2 py-1 text-white bg-slate-400 pointer-events-none leading-tight mb-4">{{ $testimonial->personnel }}</button>
                {{-- <span class="text-sm font-light text-balance">{{ $testimonial->personnel }}</span> --}}
                
            </div>
        </div>
    </div>
