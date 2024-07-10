<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;



class PostsList extends Component
{

    use WithPagination;

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public ?string $search = '';

    #[Url()]
    public $category = '';


    public function setSort($sort)
    {
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc';
        
    }

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->category = '';
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->resetPage();
    }


    #[Computed()]
    public function posts()
    {
        return Post::orderBy('published_at', $this->sort)
        ->where('title','like',"%{$this->search}%")
        ->paginate(20);
    }

    #[Computed()]
    public function word($search)
    {
        return Post::where('content', 'like', '%' . $search . '%')->get();
    }

 

    public function render()
    {
        return view('livewire.posts-list');
    }
}
