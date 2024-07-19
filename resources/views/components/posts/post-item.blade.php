@props(['post'])

<article class="[&:not(:last-child)]:border-b border-gray-200 pb-2">

    <div class="w-full overflow-hidden cursor-pointer"
        wire:navigate href="{{ route('posts.show', $post->slug) }}">
        
        <div class="text-balance flex flex-row w-full">
            
            <div class="gap-2 w-1/2">
                <img
                class="mx-auto" 
                src="/storage/{{ $post->img }}" 
                alt="{{ $post->title }}" >
                {{-- <img class="w-auto h-auto " src="{{ $post->img }}" alt=""> --}}
            </div>

            <div class="flex flex-col gap-y-2 px-10 text-left w-full">
                <div class="flex flex-row justify-between items-center">
                <span class="text-base font-light whitespace-nowrap ">{{ $post->published_at->diffForHumans() }}</span>
                <div class="w-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                      </svg>
                    </div>
                </div>

                <h1 class="text-4xl font-bold text-balance mt-1">{{ $post->title }}</h1>

                
        
                <span class="text-balance">{!! $post->getExcerpt() !!}</span>
                
                <div class="flex flex-row justify-start items-center">
                    <span class="text-base font-light w-max whitespace-nowrap rounded-md py-1/2  hover:underline">Read  </span>
                    <div class="w-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                            <path strokeLinecap="round" strokeLinejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                          </svg>
                          
                        </div>
                </div>
               

                
                  
            
            </div>

        </div>

    </div>
</article>
    
