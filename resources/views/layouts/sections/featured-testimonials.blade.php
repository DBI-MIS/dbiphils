<div class="w-full px-0 xl:px-24 py-8 border-t-2">
    <h2 class="text-4xl font-black">Why Choose Dunham-Bush?</h2>
    <span class="font-light text-base">      </span>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 mx-auto gap-2 my-5 items-start ">
@foreach ($featuredTestimonials as $testimonial)
<x-page.featured-testimonials :testimonial="$testimonial" />
@endforeach
</div>
<hr>
        <a class="mt-7 block text-center text-lg text-blue-500 font-semibold hover:text-blue-900 cursor-pointer" href="{{ route('testimonials.index') }}">View More Testimonials
        </a>

</div>
