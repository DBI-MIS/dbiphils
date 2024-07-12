<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        $categories = Cache::remember('categories', now(), function () {
            return JobCategory::whereHas('posts', function ($query) {
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $jobPost)
    {
        return view(
            'jobs.show',
            [
                'post' => $jobPost,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPost $jobPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPost $jobPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $jobPost)
    {
        //
    }
}
