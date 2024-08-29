@props(['post'])
<div class="w-full rounded-md shadow-lg py-5 px-5 mb-5 bg-white hover:bg-gray-100 border-t-2 border-blue-800 hover:scale-105 hover:z-50 transition-transform">
    <div class="grid grid-cols-4 gap-1 text-balance">
        <div class="col-span-4 w-full flex flex-row justify-between">
            <div class="block sm:inline-flex gap-2 ">
                @if ($post->urgent)
                <span class="bg-red-500 text-center py-[2px] px-[3px] rounded-lg text-white text-xs h-max order-1 sm:order-2">URGENT</span>
                @endif
                <h1 class="font-bold text-2xl order-2 sm:order-1">
                    <a wire:navigate href="{{ route('jobs.show', $post->slug) }}">{{ $post->title}}</a>
                </h1>
               
            </div>
		
        <span class="text-gray-500 text-sm text-nowrap">
            {{ $post->date_posted->gt($post->updated_at) ? $post->date_posted->diffForHumans() : $post->updated_at->diffForHumans() }}
        </span>
        </div>
        <div class="text-sm  line-clamp-2 col-span-4">@markdown($post->getExcerpt())</div>
        
        <div class="mt-3 col-span-4">
        <div class="flex items-center mb-2">
            <div class="topics flex flex-wrap justify-start gap-2">
            @foreach ($post->jobcategories()->take(3)->get() as $category)
            <x-badge wire:navigate href="{{ route('jobs.list', ['category' => $category->slug])}}"
                     :textColor="$category->text_color" :bgColor="$category->bg_color">
                {{ $category->title }}
            </x-badge>
            @endforeach
            
            </div>
            
        </div>
        </div>
    </div>

</div>