<x-app-layout title="Projects">

    <div class="mb-10 w-full">
        <div class="my-10">
            <h2 class="my-2 sm:my-4 md:my-6 text-xl xl:text-2xl text-gray-800 font-bold " animate-shake animate-infinite animate-ease-in>
                Project Installations</h2>
                <hr>
            <div class="w-full mt-6 ">
                
                <div x-data x-masonry class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                        
                    @foreach($featuredProjects as $project)
                        <x-projects.featured-project-card :project="$project" />
                    @endforeach
                
                </div>
                
            </div>
          
          
        </div>
    
        <hr>
        {{-- <a class="mt-10 block text-center text-lg text-blue-500 font-semibold"
                href="{{ route('projects.index') }}">View All
                Projects</a> --}}

        
    </div>

</x-app-layout>