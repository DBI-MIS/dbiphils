<div class="w-full px-0 xl:px-24 py-8 border-t-2">
    <h1 class="text-4xl font-black">Why Choose Us?</h1>
    <span class="font-light text-base">      </span>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 mx-auto gap-2 my-5 items-start ">
@foreach ($featuredServices as $service)
<x-page.featured-services :service="$service" />
@endforeach
</div>
<hr>

</div>
