<div class="w-full px-0 xl:px-24 py-8 border-t-2">
    <h3 class="text-3xl font-black">Our Services</h3>
    <span class="font-light text-base">      </span>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6 my-6 ">
@foreach ($aboutServices as $service)
<x-page.about-services :service="$service" />
@endforeach
</div>

</div>
