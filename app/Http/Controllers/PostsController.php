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

        $postUrl = route('posts.show', $post->slug);
        $postTitle = $post->title;


        $shareComponent = ShareFacade::page(
            $postUrl,
            $postTitle,
            [
                'class' => 'my-class',
                'id' => 'my-id',
                'title' => 'my-title',
                'rel' => 'nofollow noopener noreferrer']
            )
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

}
