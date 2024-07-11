@props(['service'])
<div class="rounded-xl border border-opacity-10 shadow-lg bg-white hover:bg-gray-100 border-blue-800 col-span-1 aspect-square items-center p-4 text-balance justify-center flex flex-col min-w-60 min-h-60 cursor-pointer hover:scale-110 hover:z-50 transition-transform">
        
        <div class="">
            <img
            class="w-16" 
            src="/storage/{{ $service->img }}" 
            alt="{{ $service->title }}" >
            {{-- <img class="w-auto h-auto " src="{{ $service->img }}" alt=""> --}}
        </div>
        
        <div class="flex flex-col gap-1 text-center">
            <span class="text-lg font-bold text-balance leading-tight mt-4 ">{{ $service->title }}</span>
            {{-- <svg class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
            </svg> --}}
            <span class="text-pretty leading-tight text-sm">{!! $service->description !!}</span>
            
            {{-- <button class="mx-auto text-base font-light rounded-xl px-2 py-1 text-white bg-blue-800 pointer-events-none leading-tight mb-4">{{ $service->personnel }}</button> --}}
            {{-- <span class="text-sm font-light text-balance">{{ $testimonial->personnel }}</span> --}}
            
        </div>

</div>