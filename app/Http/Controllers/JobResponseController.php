<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\JobResponse;
use Illuminate\Http\Request;

class JobResponseController extends Controller
{
   
    public function index()
    {
        //
    }

  
    
    public function show(JobResponse $jobResponse, JobPost $jobPost)
    {
     
        return view(
            'posts.create-job-response',
            [
                'post' => $jobPost,
                'post_title' => $jobPost->title,
                
            ]
        );
    }

    public function post_job(Request $request)
    {
        return $request->all();
    }


}
