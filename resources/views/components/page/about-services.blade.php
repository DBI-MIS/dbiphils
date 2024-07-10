@props(['service'])
<div class=" border-blue-800 col-span-1 p-4 text-balance flex flex-col  cursor-pointer hover:scale-110 hover:z-50 transition-transform">
        <div class="flex flex-row items-start justify-start min-w-[360px] space-x-4">
            <div class="w-[48px]">
                <img
                class="w-16 mx-auto" 
                src="/storage/{{ $service->img }}" 
                alt="{{ $service->title }}" >
                {{-- <img class="w-auto h-auto " src="{{ $service->img }}" alt=""> --}}
            </div>
            
            <div class="flex flex-col gap-1 text-left w-2/3 items-start justify-start">
                <span class="text-2xl font-bold text-balance leading-tight ">{{ $service->title }}</span>
               
                <span class="text-pretty leading-tight text-base">{!! $service->description !!}</span>
                
            </div>

        </div>
        

</div>