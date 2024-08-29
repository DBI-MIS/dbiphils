@props(['job'])
<article class="[&:not(:last-child)]:border-b border-gray-100 pb-10 hover:scale-105 hover:z-50 transition-transform">
    <div class="article-body grid grid-cols-8 gap-3 mt-5 items-start">
        <div class="col-span-8">
            
            <div class="inline-flex gap-2 ">
            <h2 class="text-2xl font-bold text-gray-900">
                <a wire:navigate href="{{ route('jobs.show', $job->slug) }}" >
                    {{ $job->title }}
                </a>
            </h2>
            

            @if ($job->urgent)
                <span class="bg-red-500 text-center py-[2px] px-[3px] rounded-lg text-white text-xs h-max">URGENT</span>
            @endif
        </div>
        <div class="article-meta flex py-1 text-sm items-center justify-start ">
            <span class="mr-1 text-xs">Posted By: {{ $job->author ? $job->author->name : 'hrad'}}</span>
            <span class="text-gray-500 text-xs">
                {{ $job->date_posted->gt($job->updated_at) ? $job->date_posted->diffForHumans() : $job->updated_at->diffForHumans() }}
            </span>
        </div>

            <p class="mt-2 text-base text-gray-700 font-light">
                @markdown($job->getExcerpt())
            </p>
            <div class=" flex flex-row justify-between items-center mt-6">
            <div class="article-actions-bar  flex items-center justify-start gap-2">
                @foreach ($job->jobcategories as $category)
                <x-badge wire:navigate href="{{ route('jobs.list', ['category' => $category->slug])}}"
                    :textColor="$category->text_color" :bgColor="$category->bg_color"> 
                    {{ $category->title }}
                </x-badge>
                @endforeach
                
            </div>
          
        </div>
        </div>
    </div>
</article>