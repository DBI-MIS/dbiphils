<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Jorenvh\Share\Share;
use Jorenvh\Share\ShareFacade;
use Livewire\Attributes\Computed;



class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
    
        return view(
            'posts.index',
            [
                'posts' => $posts,
            ]
        );
    }

 
    public function show(Post $post)
    {

        $postUrl = route('posts.show', $post->id);
        $postTitle = $post->title;

        $shareComponent = ShareFacade::page($postUrl, $postTitle)
        ->facebook()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();

        return view(
            'posts.show',
            [
                'post' => $post,
                'shareComponent' => $shareComponent,
            ]
        );
    }

    public function ShareWidget(Post $post)
    {
        $postUrl = route('posts.show', $post->id);
        $postTitle = $post->title;

        $shareComponent = ShareFacade::page($postUrl, $postTitle)
        ->facebook()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();
        
        return view('posts', compact('shareComponent'));
    }
}
