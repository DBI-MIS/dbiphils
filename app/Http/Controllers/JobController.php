<?php

namespace App\Http\Controllers;

use App\Models\CareerTestimonial;
use App\Models\JobCategory;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Jorenvh\Share\ShareFacade;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $featuredCareerTestimonials = CareerTestimonial::where('is_featured', true)
        ->orderBy('order', 'asc')
        ->take(4)
        ->get();
       // $featuredPosts = Cache::remember('featuredPosts', now()->addDay(), function () {
        //     return Post::where('status', true)->where('featured',true)->latest('date_posted')->take(6)->get();
        // });
        return view('jobs.index', [
            // 'featuredPosts' => $featuredPosts,
            'featuredPosts' => JobPost::where('status', true)
            ->where('featured',true)
            // ->latest('date_posted')
            ->orderByRaw('COALESCE(updated_at, date_posted) DESC')
            ->take(6)
            ->get(),
            'featuredCareerTestimonials' => $featuredCareerTestimonials,

        ]);
    }

    public function list()
    {
        $categories = Cache::remember('job_categories', now(), function () {
            return JobCategory::whereHas('jobposts', function ($query) {
                $query->published();
            })->take(20)->get();
        });

        return view(
            'jobs.list',
            [
                'categories' => $categories,

            ]
        );
    }

    public function show(JobPost $job)
    {
        $jobUrl = route('jobs.show', $job->slug);
        $jobTitle = $job->title;

        $shareComponent = ShareFacade::page($jobUrl, $jobTitle,[
            'class' => 'my-class',
            'id' => 'my-id',
            'title' => 'Share '. $jobTitle,
            'rel' => 'nofollow noopener noreferrer'])
        ->facebook()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();

        return view(
            'jobs.show',
            [
                'job' => $job,
                'shareComponent' => $shareComponent,
            ]
        );
       
    }

    public function ShareWidget(JobPost $job)
    {
        $jobUrl = route('jobs.show', $job->slug);
        $jobTitle = $job->title;

        $shareComponent = ShareFacade::page($jobUrl, $jobTitle)
        ->facebook()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();
        
        return view('jobs', compact('shareComponent'));
    }

}
