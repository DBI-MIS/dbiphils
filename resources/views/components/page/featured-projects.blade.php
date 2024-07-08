@props(['project'])
<div class="rounded-xl border border-opacity-10 shadow-lg bg-white hover:bg-gray-100 border-blue-800 col-span-1 overflow-hidden">
    <div class="text-balance flex flex-col" 
    wire:navigate href="{{ route('home') }}"
    >
        
        <div class="gap-2">
            <img
            class="w-full" 
            src="/storage/{{ $project->img }}" 
            alt="{{ $project->title }}" >
            {{-- <img class="w-auto h-auto " src="{{ $project->img }}" alt=""> --}}
        </div>
        <div class="flex flex-col text-left gap-3 px-10 py-4">
            <button class="text-base font-light w-max whitespace-nowrap rounded-xl px-2 py-1 tracking-wide text-white bg-blue-800">{{ $project->category }}</button>
            <span class="text-3xl font-bold text-balance">{{ $project->title }}</span>
            <span class="text-sm font-light text-balance">{{ $project->description }}</span>
        </div>
        
       
        
    
    </div>

</div>