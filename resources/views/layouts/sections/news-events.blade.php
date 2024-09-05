<div class="w-full px-0 xl:px-24 py-8 border-t-2">
    <h2 class="text-4xl font-black">News & Events</h2>
    <span class="font-light text-base">      </span>
<div class="flex flex-col sm:grid sm:grid-cols-2 md:grid-cols-3 mx-auto gap-2 my-5">
@foreach ($featuredNews as $post)
<x-page.featured-news :post="$post" />
@endforeach
</div>
<hr>
        <a class="mt-7 block text-center text-lg text-blue-500 font-semibold hover:text-blue-900 cursor-pointer" href="{{ route('posts.index') }}">More News & Events
        </a>

</div>
