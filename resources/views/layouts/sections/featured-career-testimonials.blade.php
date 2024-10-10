<div class="w-full px-0 xl:px-24 py-8 border-t-2">
    <h2 class="text-4xl font-black">Why Choose Us?</h2>
    <span class="font-light text-base">      </span>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mx-auto gap-2 my-5 items-start ">
@foreach ($featuredCareerTestimonials as $testimonial)
<x-page.featured-career-testimonials :testimonial="$testimonial" />
@endforeach
</div>
<hr>
        <a class="mt-7 block text-center text-lg text-blue-500 font-semibold hover:text-blue-900 cursor-pointer" href="{{ route('career-testimonials.index') }}">View More
        </a>

</div>
