<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{
   

    public function index()
{
    // $categories = Project::pluck('category')->unique();

        $featuredProjects = Project::where('status', true)
        ->where('featured', true)
        ->latest('published_at')
        ->take(20)
        ->get();
    
        $nonFeaturedProjects = Project::where('status', true)
        ->where('featured', false)
        ->latest('published_at')
        ->take(100 - $featuredProjects->count())
        ->get();

        $projects = $featuredProjects->merge($nonFeaturedProjects);
   

    return view(
        'projects.index',
        [
            // 'categories' => $categories,
            'featuredProjects' => $projects,
        ]
    );
}


  
    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view(
            'projects.show',
            [
                'project' => $project,
            ]
        );
    }

}
