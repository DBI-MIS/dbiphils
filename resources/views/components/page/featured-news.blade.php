@props(['post'])
<div class="rounded-xl border border-opacity-10 shadow-lg bg-white hover:bg-gray-100 border-blue-800 col-span-1 overflow-hidden
cursor-pointer hover:scale-110 hover:z-50 transition-transform">
    <a href="{{ route('posts.show', $post->slug) }}">
    <div class="text-balance flex flex-col">
        <div class="gap-2">
            <img
            class="w-full" 
            src="/storage/{{ $post->img }}" 
            alt="{{ $post->title }}" >
            {{-- <img class="w-auto h-auto " src="{{ $post->img }}" alt=""> --}}
        </div>
        <div class="flex flex-col text-left gap-3 px-10 py-4">
            <button class="text-base font-light w-max whitespace-nowrap rounded-xl px-2 py-1 text-white bg-blue-800">{{ $post->published_at->diffForHumans() }}</button>
            <span class="text-3xl font-bold text-balance">{{ $post->title }}</span>
            <span class="text-sm font-light text-balance">{!! $post->getExcerpt() !!}</span>
        </div>
    </div>
</a>

</div>