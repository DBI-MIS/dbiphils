<div class="w-full px-0 xl:px-24 py-8 border-t-2">
    <h1 class="text-4xl font-black">Project Installations</h1>
    <span class="font-light text-base">Dunham-Bush Provides Leading Green-Cooling Products Around The Globe</span>
<div class="flex flex-col sm:grid sm:grid-cols-2 md:grid-cols-3 mx-auto gap-2 my-5 ">
@foreach ($featuredProjects as $project)
<x-page.featured-projects :project="$project" />
@endforeach
</div>
<hr>
        <a class="mt-2 block text-center text-lg text-blue-500 font-semibold hover:text-blue-900 cursor-pointer" href="{{ route('home') }}">View All Projects
        </a>

</div>
