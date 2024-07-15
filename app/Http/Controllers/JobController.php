<?php

namespace App\Http\Controllers;

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
       // $featuredPosts = Cache::remember('featuredPosts', now()->addDay(), function () {
        //     return Post::where('status', true)->where('featured',true)->latest('date_posted')->take(6)->get();
        // });
        return view('jobs.index', [
            // 'featuredPosts' => $featuredPosts,
            'featuredPosts' => JobPost::where('status', true)->where('featured',true)->latest('date_posted')->take(6)->get(),

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
        $jobUrl = route('jobs.show', $job->id);
        $jobTitle = $job->title;

        $shareComponent = ShareFacade::page($jobUrl, $jobTitle)
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
        $jobUrl = route('jobs.show', $job->id);
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
