<div class=" px-3 lg:px-7 py-6">
   
    <div x-data x-masonry class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($this->testimonials as $testimonial)
        <x-career-testimonials.testimonial-item :testimonial="$testimonial"/>
        @endforeach
    </div>

 
    <hr>

</div>