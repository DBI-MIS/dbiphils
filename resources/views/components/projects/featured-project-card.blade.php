@props(['project'])
<div class="h-max w-full mb-2 rounded-xl border overflow-hidden border-opacity-10 shadow-lg bg-white hover:bg-gray-50 border-blue-800 relative hover:scale-110 md:hover:scale-125 hover:z-50 transition-transform">
    <div 
    class="flex flex-col md:flex-row text-balance h-max" 
    wire:navigate href="{{ route('projects.show', $project->slug) }}">
   
    @if ($project->featured)
    <div class="absolute right-2 top-2 text-red-500">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
          </svg>
    </div>
    @endif
        <div class="h-min w-full md:w-2/3">
           <img class="w-full bg-white" 
            src="/storage/{{ $project->img }}" 
            alt="">
            <img class="w-full bg-blue-800" 
            src="{{ $project->img }}" 
            alt="">
        </div>
        <div class="w-full flex flex-col p-2 my-auto">
            
            
		<span class="font-bold text-lg">
        <a wire:navigate href="{{ route('projects.show', $project->slug) }}">{{ $project->name}}</a>
        </span>
        <span class="font-light text-sm">{{ $project->address}}</span>
        </div>
       
        
    
    </div>
    

</div>