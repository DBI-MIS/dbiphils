<?php

namespace App\Livewire;

use App\Models\JobCategory;
use App\Models\JobPost;
use Illuminate\Contracts\Queue\Job;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class JobPostList extends Component
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
        return JobPost::orderBy('date_posted', $this->sort)->where('status',true)
        // where('title','like',"%{$this->search}%")
        

        ->when($this->activeCategory, function ($query)
        {
            $query->withCategory($this->category);
        })
        ->search($this->search)
        ->paginate(5);
    }

    #[Computed()]
    public function activeCategory()
    {
        return JobCategory::where('slug', $this->category)->first();
    }
    

    public function render()
    {
        return view('livewire.job-post-list');
    }
}
